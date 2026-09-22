<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminActivityLogModel;

class Logs extends BaseController
{
    protected AdminActivityLogModel $logModel;

    public function __construct()
    {
        $this->logModel = new AdminActivityLogModel();
    }

    /**
     * Display administrative activity audit logs.
     */
    public function index(): string
    {
        $actionFilter = trim((string) $this->request->getGet('action'));
        $searchQuery  = trim((string) $this->request->getGet('q'));

        $builder = $this->logModel->orderBy('id', 'DESC');

        if (! empty($actionFilter)) {
            $builder->where('action', strtoupper($actionFilter));
        }

        if (! empty($searchQuery)) {
            $builder->groupStart()
                ->like('description', $searchQuery)
                ->orLike('admin_name', $searchQuery)
                ->orLike('ip_address', $searchQuery)
                ->groupEnd();
        }

        // Limit to 100 most recent logs with simple pager
        $logs = $builder->findAll(100);

        // Action categories for filter
        $availableActions = [
            'LOGIN'           => 'Masuk Sistem (Login)',
            'LOGOUT'          => 'Keluar Sistem (Logout)',
            'USER_CREATE'     => 'Tambah Pengguna',
            'USER_UPDATE'     => 'Ubah Pengguna',
            'USER_DELETE'     => 'Hapus Pengguna',
            'SETTINGS_UPDATE' => 'Ubah Identitas / Kontak',
            'LOGS_CLEANUP'    => 'Pembersihan Log',
        ];

        // Stats
        $totalLogs    = $this->logModel->countAllResults();
        $thirtyDaysAgo = date('Y-m-d H:i:s', strtotime('-30 days'));
        $oldLogsCount = $this->logModel->where('created_at <', $thirtyDaysAgo)->countAllResults();

        $data = [
            'title'            => 'Audit Trail & Log Aktivitas Admin - NNSRC UMRAH',
            'logs'             => $logs,
            'totalLogs'        => $totalLogs,
            'oldLogsCount'     => $oldLogsCount,
            'actionFilter'     => $actionFilter,
            'searchQuery'      => $searchQuery,
            'availableActions' => $availableActions,
        ];

        return view('admin/logs/index', $data);
    }

    /**
     * Purge activity logs older than 30 days.
     */
    public function clearOlder()
    {
        $thirtyDaysAgo = date('Y-m-d H:i:s', strtotime('-30 days'));

        $countBefore = $this->logModel->where('created_at <', $thirtyDaysAgo)->countAllResults();

        if ($countBefore === 0) {
            return redirect()->to(base_url('admin/logs'))
                ->with('error', 'Tidak ada log aktivitas yang lebih lama dari 30 hari untuk dibersihkan.');
        }

        $this->logModel->where('created_at <', $thirtyDaysAgo)->delete();

        AdminActivityLogModel::record(
            'LOGS_CLEANUP',
            "Pembersihan otomatis: {$countBefore} riwayat audit log aktivitas yang berusia lebih dari 30 hari telah dihapus dari basis data."
        );

        return redirect()->to(base_url('admin/logs'))
            ->with('success', "Pembersihan selesai. {$countBefore} berkas log aktivitas lama berhasil dibersihkan!");
    }
}
