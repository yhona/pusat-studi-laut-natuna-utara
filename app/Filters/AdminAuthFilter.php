<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (! $session->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'))
                ->with('error', 'Silakan masuk terlebih dahulu untuk mengakses dashboard admin.');
        }

        $adminId = (int) $session->get('admin_id');
        if ($adminId > 0) {
            $userModel = new \App\Models\AdminUserModel();
            $user = $userModel->find($adminId);
            if (! $user || (isset($user['is_active']) && (int) $user['is_active'] !== 1)) {
                $session->destroy();
                return redirect()->to(base_url('admin/login'))
                    ->with('error', 'Sesi Anda telah berakhir atau akun Anda telah dinonaktifkan.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No post-processing needed
    }
}
