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

        $name     = trim($this->request->getPost('name') ?? '');
        $email    = trim($this->request->getPost('email') ?? '');
        $username = trim($this->request->getPost('username') ?? '');

        if ($name === '' || $email === '' || $username === '') {
            return redirect()->back()->with('error', 'Nama, email, dan username tidak boleh kosong.');
        }

        $updateData = [
            'name'     => $name,
            'email'    => $email,
            'username' => $username,
        ];

        // If changing password
        $newPassword     = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if (! empty($newPassword)) {
            if (strlen($newPassword) < 8) {
                return redirect()->back()->with('error', 'Kata sandi baru minimal harus 8 karakter.');
            }
            if ($newPassword !== $confirmPassword) {
                return redirect()->back()->with('error', 'Konfirmasi kata sandi baru tidak cocok.');
            }
            $updateData['password_hash'] = password_hash($newPassword, PASSWORD_BCRYPT);
        }

        $this->userModel->update($adminId, $updateData);

        // Update session
        session()->set([
            'admin_name'     => $name,
            'admin_username' => $username,
            'admin_email'    => $email,
        ]);

        return redirect()->to(base_url('admin/pengaturan'))
            ->with('success', 'Profil dan kredensial administrator berhasil diperbarui!');
    }
}
