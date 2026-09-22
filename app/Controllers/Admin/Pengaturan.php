<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;

class Pengaturan extends BaseController
{
    protected AdminUserModel $userModel;

    public function __construct()
    {
        $this->userModel = new AdminUserModel();
    }

    public function index(): string
    {
        $adminId = (int) session('admin_id');
        $user = $this->userModel->find($adminId);

        $data = [
            'title' => 'Pengaturan Akun & Keamanan - Admin NNSRC',
            'user'  => $user,
        ];

        return view('admin/pengaturan/index', $data);
    }

    public function updateProfile()
    {
        $adminId = (int) session('admin_id');
        $user = $this->userModel->find($adminId);
        if (! $user) {
            return redirect()->to(base_url('admin/pengaturan'))->with('error', 'Pengguna tidak ditemukan.');
        }

        $rules = [
            'name'     => 'required|min_length[2]|max_length[150]',
            'username' => "required|min_length[3]|max_length[100]|alpha_dash|is_unique[admin_users.username,id,{$adminId}]",
            'email'    => "required|valid_email|max_length[150]|is_unique[admin_users.email,id,{$adminId}]",
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

        $name     = trim((string) $this->request->getPost('name'));
        $email    = trim((string) $this->request->getPost('email'));
        $username = trim((string) $this->request->getPost('username'));

        $updateData = [
            'name'     => $name,
            'email'    => $email,
            'username' => $username,
        ];

        if (! empty($newPassword)) {
            $updateData['password_hash'] = password_hash($newPassword, PASSWORD_BCRYPT);
        }

        $this->userModel->update($adminId, $updateData);

        // Update session
        session()->set([
            'admin_name'     => $name,
            'admin_username' => $username,
            'admin_email'    => $email,
        ]);

        \App\Models\AdminActivityLogModel::record(
            'USER_UPDATE',
            "Memperbarui profil akun sendiri via Pengaturan Akun: {$name} (@{$username})" . (! empty($newPassword) ? ' [Password diubah]' : '')
        );

        return redirect()->to(base_url('admin/pengaturan'))
            ->with('success', 'Profil dan kredensial administrator berhasil diperbarui!');
    }
}
