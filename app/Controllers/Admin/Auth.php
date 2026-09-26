<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    protected AdminUserModel $userModel;

    public function __construct()
    {
        $this->userModel = new AdminUserModel();
    }

    /**
     * Show admin login form.
     */
    public function login()
    {
        if (session()->get('admin_logged_in')) {
            return redirect()->to(base_url('admin'));
        }

        $isDev = (ENVIRONMENT === 'development');
        $justLoggedOut = (bool) session()->getFlashdata('just_logged_out');

        // Allow instant bypass with ?auto=1 in development mode
        if ($isDev && ! $justLoggedOut && $this->request->getGet('auto') === '1') {
            return $this->devLogin();
        }

        $data = [
            'title'         => 'Login Administrator - Pusat Studi Laut Natuna Utara UMRAH',
            'error'         => session()->getFlashdata('error'),
            'success'       => session()->getFlashdata('success'),
            'isDev'         => $isDev,
            'justLoggedOut' => $justLoggedOut,
            'defaultUser'   => $isDev ? $this->userModel->where('role', 'superadmin')->where('is_active', 1)->first() : null,
        ];

        return view('admin/auth/login', $data);
    }

    /**
     * Development Mode Instant Auto-Login.
     * Accessible exclusively when ENVIRONMENT === 'development'.
     */
    public function devLogin()
    {
        if (ENVIRONMENT !== 'development') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Fitur login otomatis hanya dapat diakses pada mode development.');
        }

        $user = $this->userModel->where('role', 'superadmin')->where('is_active', 1)->first()
             ?? $this->userModel->where('is_active', 1)->first()
             ?? $this->userModel->first();

        if (! $user) {
            return redirect()->to(base_url('admin/login'))
                ->with('error', 'Akun administrator belum terdaftar di database.');
        }

        // Set session
        session()->set([
            'admin_logged_in' => true,
            'admin_id'        => $user['id'],
            'admin_username'  => $user['username'],
            'admin_name'      => $user['name'],
            'admin_email'     => $user['email'],
            'admin_role'      => $user['role'],
        ]);

        \App\Models\AdminActivityLogModel::record(
            'DEV_LOGIN',
            'Login otomatis berhasil via Mode Development.',
            (int) $user['id'],
            $user['name']
        );

        $targetUrl = session()->get('redirect_url') ?? base_url('admin');
        session()->remove('redirect_url');

        return redirect()->to($targetUrl)
            ->with('success', '⚡ Mode Dev: Berhasil masuk otomatis sebagai ' . esc($user['name']) . ' (' . esc($user['username']) . ').');
    }

    /**
     * Handle login authentication.
     */
    public function loginAction()
    {
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        if (empty($username) || empty($password)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Silakan masukkan nama pengguna/email dan kata sandi.');
        }

        $user = $this->userModel->verifyCredentials($username, $password);

        if (! $user) {
            \App\Models\AdminActivityLogModel::record(
                'LOGIN_FAILED',
                "Percobaan login gagal untuk identitas: '{$username}'. Kredensial tidak cocok atau akun dinonaktifkan."
            );

            return redirect()->back()
                ->withInput()
                ->with('error', 'Kombinasi nama pengguna/email dan kata sandi tidak cocok, atau akun dinonaktifkan.');
        }

        // Set session
        session()->set([
            'admin_logged_in' => true,
            'admin_id'        => $user['id'],
            'admin_username'  => $user['username'],
            'admin_name'      => $user['name'],
            'admin_email'     => $user['email'],
            'admin_role'      => $user['role'],
        ]);

        \App\Models\AdminActivityLogModel::record(
            'LOGIN',
            'Berhasil masuk ke sesi panel administrasi.',
            (int) $user['id'],
            $user['name']
        );

        $targetUrl = session()->get('redirect_url') ?? base_url('admin');
        session()->remove('redirect_url');

        return redirect()->to($targetUrl)
            ->with('success', 'Selamat datang kembali, ' . esc($user['name']) . '!');
    }

    /**
     * Log out from admin panel.
     */
    public function logout()
    {
        $adminId   = (int) (session('admin_id') ?? 0);
        $adminName = (string) (session('admin_name') ?? 'Admin');

        if ($adminId > 0) {
            \App\Models\AdminActivityLogModel::record(
                'LOGOUT',
                'Keluar dari sesi panel administrasi.',
                $adminId,
                $adminName
            );
        }

        session()->destroy();
        return redirect()->to(base_url('admin/login'))
            ->with('success', 'Anda telah berhasil keluar dari sistem.')
            ->with('just_logged_out', 1);
    }
}
