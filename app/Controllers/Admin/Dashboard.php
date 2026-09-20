<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BeritaModel;
use App\Models\UnduhanModel;
use App\Models\UnduhanPermohonanModel;
use App\Models\KontakPesanModel;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $beritaModel     = new BeritaModel();
        $unduhanModel    = new UnduhanModel();
        $permohonanModel = new UnduhanPermohonanModel();
        $kontakModel     = new KontakPesanModel();

        $stats = [
            'total_berita'     => $beritaModel->countAllResults(),
            'total_unduhan'    => $unduhanModel->countAllResults(),
            'total_permohonan' => $permohonanModel->countAllResults(),
            'total_kontak'     => $kontakModel->countAllResults(),
            'total_downloads'  => (int) ($unduhanModel->selectSum('downloads')->first()['downloads'] ?? 0),
        ];

        // Recent permohonan unduh
        $recentPermohonan = $permohonanModel->orderBy('id', 'DESC')->findAll(5);

        // Recent kontak pesan
        $recentKontak = $kontakModel->orderBy('id', 'DESC')->findAll(5);

        // Cron status file
        $cronStatusFile = WRITEPATH . 'cron_status.json';
        $cronStatus = null;
        if (file_exists($cronStatusFile)) {
            $cronStatus = json_decode(file_get_contents($cronStatusFile), true);
        }

        $data = [
            'title'            => 'Dashboard Ringkasan',
            'stats'            => $stats,
            'recentPermohonan' => $recentPermohonan,
            'recentKontak'     => $recentKontak,
            'cronStatus'       => $cronStatus,
        ];

        return view('admin/dashboard/index', $data);
    }

    /**
     * Manual trigger to execute 15-minute cron job immediately from web dashboard.
     */
    public function runCron()
    {
        try {
            $cronService = new \App\Services\CronMaintenanceService();
            $result = $cronService->execute();

            return redirect()->to(base_url('admin/dashboard'))
                ->with('success', 'Cronjob pemeliharaan berkala 15 menit berhasil dijalankan! ' . esc($result['message']));
        } catch (\Throwable $e) {
            return redirect()->to(base_url('admin/dashboard'))
                ->with('error', 'Gagal menjalankan cronjob: ' . esc($e->getMessage()));
        }
    }
}
