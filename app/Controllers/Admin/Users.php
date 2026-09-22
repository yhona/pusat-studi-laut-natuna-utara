<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;
use App\Models\AdminActivityLogModel;

class Users extends BaseController
{
    protected AdminUserModel $userModel;

    public function __construct()
    {
        $this->userModel = new AdminUserModel();
    }

    /**
     * Display listing of admin users.
     */
    public function index(): string
    {
        $users = $this->userModel->orderBy('id', 'ASC')->findAll();

        $data = [
            'title' => 'Manajemen Pengguna Admin - Pusat Studi Laut Natuna Utara UMRAH',
            'users' => $users,
        ];

        return view('admin/users/index', $data);
    }

    /**
     * Form to create a new admin user.
     */
    public function create(): string
    {
        $data = [
            'title' => 'Tambah Pengguna Admin Baru - NNSRC UMRAH',
        ];

        return view('admin/users/create', $data);
    }

    /**
     * Store a newly created admin user.
     */
    public function store()
    {
        $rules = [
            'name'             => 'required|min_length[2]|max_length[150]',
            'username'         => 'required|min_length[3]|max_length[100]|alpha_dash|is_unique[admin_users.username]',
            'email'            => 'required|valid_email|max_length[150]|is_unique[admin_users.email]',
            'password'         => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
            'role'             => 'required|in_list[administrator,superadmin,editor]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $this->validator->getErrors()));
        }

        $passwordHash = password_hash((string) $this->request->getPost('password'), PASSWORD_BCRYPT);
        $isActive     = $this->request->getPost('is_active') ? 1 : 0;

        $insertData = [
            'name'          => trim((string) $this->request->getPost('name')),
            'username'      => trim((string) $this->request->getPost('username')),
            'email'         => trim((string) $this->request->getPost('email')),
            'password_hash' => $passwordHash,
            'role'          => (string) $this->request->getPost('role'),
            'is_active'     => $isActive,
        ];

        $inserted = $this->userModel->insert($insertData);

        if (! $inserted) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan akun administrator baru.');
        }

        AdminActivityLogModel::record(
            'USER_CREATE',
            "Menambahkan akun administrator baru: {$insertData['username']} ({$insertData['email']}), Peran: {$insertData['role']}"
        );

        return redirect()->to(base_url('admin/users'))
            ->with('success', 'Akun administrator baru berhasil didaftarkan.');
    }

    /**
     * Form to edit an admin user.
     */
    public function edit(int $id)
    {
        $user = $this->userModel->find($id);
        if (! $user) {
            return redirect()->to(base_url('admin/users'))->with('error', 'Akun administrator tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Pengguna Admin - NNSRC UMRAH',
            'user'  => $user,
        ];

        return view('admin/users/edit', $data);
    }

    /**
     * Update an admin user record.
     */
    public function update(int $id)
    {
        $user = $this->userModel->find($id);
        if (! $user) {
            return redirect()->to(base_url('admin/users'))->with('error', 'Akun administrator tidak ditemukan.');
        }

        $currentAdminId = (int) (session('admin_id') ?? 0);

        $rules = [
            'name'     => 'required|min_length[2]|max_length[150]',
            'username' => "required|min_length[3]|max_length[100]|alpha_dash|is_unique[admin_users.username,id,{$id}]",
            'email'    => "required|valid_email|max_length[150]|is_unique[admin_users.email,id,{$id}]",
            'role'     => 'required|in_list[administrator,superadmin,editor]',
        ];

        $newPassword = trim((string) $this->request->getPost('new_password'));
        if (! empty($newPassword)) {
            $rules['new_password']     = 'min_length[8]';
            $rules['confirm_password'] = 'required|matches[new_password]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $this->validator->getErrors()));
        }

        $isActive = $this->request->getPost('is_active') ? 1 : 0;
        $newRole  = (string) $this->request->getPost('role');

        // Protection Rule: Cannot deactivate own logged-in account
        if ($id === $currentAdminId && $isActive === 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Keamanan Sistem: Anda tidak dapat menonaktifkan akun Anda sendiri yang sedang aktif digunakan.');
        }

        // Protection Rule: Cannot deactivate or demote the last remaining active administrator/superadmin
        if (in_array($user['role'], ['administrator', 'superadmin'], true)) {
            if ($isActive === 0 || $newRole === 'editor') {
                $privilegedCount = (new AdminUserModel())
                    ->whereIn('role', ['administrator', 'superadmin'])
                    ->where('is_active', 1)
                    ->countAllResults();

                if ($privilegedCount <= 1 && (int) ($user['is_active'] ?? 1) === 1) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Keamanan Sistem: Tidak dapat menonaktifkan atau menurunkan hak akses satu-satunya administrator/superadmin aktif di sistem.');
                }
            }
        }

        $updateData = [
            'name'      => trim((string) $this->request->getPost('name')),
            'username'  => trim((string) $this->request->getPost('username')),
            'email'     => trim((string) $this->request->getPost('email')),
            'role'      => $newRole,
            'is_active' => $isActive,
        ];

        if (! empty($newPassword)) {
            $updateData['password_hash'] = password_hash($newPassword, PASSWORD_BCRYPT);
        }

        $this->userModel->update($id, $updateData);

        // If self was updated, synchronize active session
        if ($id === $currentAdminId) {
            session()->set([
                'admin_name'     => $updateData['name'],
                'admin_username' => $updateData['username'],
                'admin_email'    => $updateData['email'],
                'admin_role'     => $updateData['role'],
            ]);
        }

        AdminActivityLogModel::record(
            'USER_UPDATE',
            "Memperbarui data akun administrator: {$updateData['username']} (ID: {$id})" . (! empty($newPassword) ? ' [Password diubah]' : '')
        );

        return redirect()->to(base_url('admin/users'))
            ->with('success', 'Data administrator berhasil diperbarui.');
    }

    /**
     * Delete an admin user.
     */
    public function delete(int $id)
    {
        $currentAdminId = (int) (session('admin_id') ?? 0);

        // Protection Rule: Cannot delete own logged-in account
        if ($id === $currentAdminId) {
            return redirect()->to(base_url('admin/users'))
                ->with('error', 'Keamanan Sistem: Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif digunakan.');
        }

        $user = $this->userModel->find($id);
        if (! $user) {
            return redirect()->to(base_url('admin/users'))
                ->with('error', 'Akun administrator tidak ditemukan.');
        }

        // Protection Rule: Cannot delete if only 1 admin account remains
        if ($this->userModel->countAllResults() <= 1) {
            return redirect()->to(base_url('admin/users'))
                ->with('error', 'Keamanan Sistem: Tidak dapat menghapus satu-satunya akun administrator yang tersisa di sistem.');
        }

        // Protection Rule: Cannot delete the last active administrator/superadmin
        if (in_array($user['role'], ['administrator', 'superadmin'], true)) {
            $privilegedCount = (new AdminUserModel())
                ->whereIn('role', ['administrator', 'superadmin'])
                ->where('is_active', 1)
                ->countAllResults();

            if ($privilegedCount <= 1 && (int) ($user['is_active'] ?? 1) === 1) {
                return redirect()->to(base_url('admin/users'))
                    ->with('error', 'Keamanan Sistem: Tidak dapat menghapus satu-satunya akun administrator/superadmin aktif yang tersisa di sistem.');
            }
        }

        $this->userModel->delete($id);

        AdminActivityLogModel::record(
            'USER_DELETE',
            "Menghapus akun administrator: {$user['username']} ({$user['email']}, ID: {$id})"
        );

        return redirect()->to(base_url('admin/users'))
            ->with('success', "Akun administrator '{$user['username']}' berhasil dihapus.");
    }
}
