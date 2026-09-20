<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Services\CronMaintenanceService;

class Sistem extends BaseController
{
    public function index(): string
    {
        // Cron status
        $cronStatusFile = WRITEPATH . 'cron_status.json';
        $cronStatus = null;
        if (file_exists($cronStatusFile)) {
            $cronStatus = json_decode(file_get_contents($cronStatusFile), true);
        }

        // Recent cron logs
        $logFile = WRITEPATH . 'logs/cron_maintenance.log';
        $recentLogs = [];
        if (file_exists($logFile)) {
            $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if (is_array($lines)) {
                $recentLogs = array_reverse(array_slice($lines, -15));
            }
        }

        // Database info
        $dbFile = WRITEPATH . 'database.sqlite';
        $dbSize = file_exists($dbFile) ? round(filesize($dbFile) / 1024, 2) . ' KB' : 'N/A';

        // Cache info
        $cacheDir = WRITEPATH . 'cache';
        $cacheCount = 0;
        if (is_dir($cacheDir)) {
            $cacheFiles = glob($cacheDir . '/*');
            $cacheCount = is_array($cacheFiles) ? count($cacheFiles) : 0;
        }

        $systemInfo = [
            'php_version'    => PHP_VERSION,
            'ci_version'     => \CodeIgniter\CodeIgniter::CI_VERSION,
            'server_os'      => php_uname('s') . ' ' . php_uname('r'),
            'db_driver'      => 'SQLite3',
            'db_size'        => $dbSize,
            'cache_files'    => $cacheCount,
            'memory_usage'   => round(memory_get_usage(true) / 1024 / 1024, 2) . ' MB',
        ];

        $data = [
            'title'      => 'Status Sistem & Otomatisasi 20 Menit - Admin NNSRC',
            'cronStatus' => $cronStatus,
            'recentLogs' => $recentLogs,
            'systemInfo' => $systemInfo,
        ];

        return view('admin/sistem/index', $data);
    }

    public function clearCache()
    {
        $cacheDir = WRITEPATH . 'cache';
        $deleted = 0;
        if (is_dir($cacheDir)) {
            $files = glob($cacheDir . '/*');
            foreach ($files as $f) {
                if (is_file($f) && basename($f) !== '.gitkeep') {
                    @unlink($f);
                    $deleted++;
                }
            }
        }

        return redirect()->to(base_url('admin/sistem'))
            ->with('success', "Pembersihan cache selesai. {$deleted} berkas cache berhasil dibersihkan!");
    }
}
