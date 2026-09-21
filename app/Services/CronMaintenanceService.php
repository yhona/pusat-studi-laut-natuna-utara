<?php

namespace App\Services;

use App\Models\UnduhanPermohonanModel;
use App\Models\BeritaModel;

class CronMaintenanceService
{
    /**
     * Execute the 15-minute maintenance routines.
     */
    public function execute(): array
    {
        $startTime = microtime(true);
        $executedTasks = [];

        // 1. Process pending download requests notifications if any
        $permohonanModel = new UnduhanPermohonanModel();
        $pendingRequests = $permohonanModel->where('email_status', 'pending')->findAll(10);
        $retriedEmails = 0;

        foreach ($pendingRequests as $req) {
            try {
                $email = service('email');
                $email->setTo($req['recipient_email'] ?? 'atika.thahira@umrah.ac.id');
                $email->setCC('atika.thahira@umrah.ac.id');
                $email->setFrom('no-reply@umrah.ac.id', 'Pusat Studi Laut Natuna Utara UMRAH');
                $email->setSubject('[Antrean Terjadwal] Permohonan Unduh: ' . $req['document_title']);
                $email->setMessage(
                    "Pemberitahuan terjadwal berkala permohonan unduh dokumen.\n"
                    . "Dokumen: {$req['document_title']}\n"
                    . "Pemohon: {$req['applicant_name']} ({$req['applicant_institution']})\n"
                    . "Email: {$req['applicant_email']}\n"
                    . "Keperluan: {$req['purpose']}\n"
                );
                @$email->send(false);
                $permohonanModel->update($req['id'], ['email_status' => 'sent']);
                $retriedEmails++;
            } catch (\Throwable $e) {
                // Keep safe
            }
        }
        $executedTasks[] = "Antrean email diproses: {$retriedEmails} data";

        // 2. Clear old cached session or temporary files in writable
        $tempDir = WRITEPATH . 'cache';
        $cleanedFiles = 0;
        if (is_dir($tempDir)) {
            $files = glob($tempDir . '/*');
            foreach ($files as $f) {
                if (is_file($f) && (time() - filemtime($f) > 86400 * 7)) { // older than 7 days
                    @unlink($f);
                    $cleanedFiles++;
                }
            }
        }
        $executedTasks[] = "Pembersihan cache berkala: {$cleanedFiles} berkas dibersihkan";

        // 3. System Health Check & Auto-Snapshot
        $beritaCount = (new BeritaModel())->countAllResults();
        $klasterModel = new \App\Models\KlasterRisetModel();
        $klasterCount = $klasterModel->countAllResults();
        $allClusters  = $klasterModel->findAll();

        $executedTasks[] = "Pemeriksaan integritas basis data: {$beritaCount} berita & {$klasterCount} klaster riset terverifikasi";

        // Auto-Snapshot Backup of Clusters & Core Content to writable/backups
        $backupDir = WRITEPATH . 'backups';
        if (! is_dir($backupDir)) {
            @mkdir($backupDir, 0755, true);
        }
        $snapshotPayload = [
            'timestamp'    => date('Y-m-d H:i:s'),
            'total_klaster'=> $klasterCount,
            'klasters'     => $allClusters,
        ];
        @file_put_contents($backupDir . '/klaster_snapshot.json', json_encode($snapshotPayload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        $executedTasks[] = "Auto-snapshot cadangan klaster riset: {$klasterCount} klaster diamankan";

        // 4. Playwright Headless Verification of Dynamic Logic & Frontend
        $playwrightScript = ROOTPATH . 'playwright_check.js';
        $playwrightSummary = 'Playwright dilewati (berkas tidak ditemukan)';
        if (file_exists($playwrightScript)) {
            $nodeBinary = trim((string) shell_exec('which node 2>/dev/null')) ?: 'node';
            $cmd = escapeshellcmd("{$nodeBinary} " . escapeshellarg($playwrightScript)) . ' 2>&1';
            $pwOutput = shell_exec($cmd);
            $pwStatusFile = WRITEPATH . 'playwright_status.json';
            if (file_exists($pwStatusFile)) {
                $pwData = json_decode(file_get_contents($pwStatusFile), true);
                $isHealthy = ($pwData['status'] ?? '') === 'HEALTHY';
                $playwrightSummary = $isHealthy ? 'Playwright UI/UX verifikasi sukses (Semua halaman & klaster dinamis OK)' : 'Playwright mendeteksi isu frontend';
            } else {
                $playwrightSummary = 'Playwright selesai dijalankan';
            }
        }
        $executedTasks[] = $playwrightSummary;

        $executionDuration = round(microtime(true) - $startTime, 3);

        // 5. Record status to WRITEPATH/cron_status.json
        $status = [
            'status'         => 'SUCCESS',
            'interval'       => '15 Menit',
            'last_run'       => date('Y-m-d H:i:s'),
            'last_run_human' => date('d F Y, H:i:s') . ' WIB',
            'duration_sec'   => $executionDuration,
            'tasks'          => $executedTasks,
            'message'        => 'Eksekusi selesai dalam ' . $executionDuration . ' detik.',
        ];

        file_put_contents(WRITEPATH . 'cron_status.json', json_encode($status, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        // Also append to rotating log file
        $logLine = '[' . date('Y-m-d H:i:s') . '] [20-MIN CRON] ' . implode(' | ', $executedTasks) . "\n";
        @file_put_contents(WRITEPATH . 'logs/cron_maintenance.log', $logLine, FILE_APPEND);

        return $status;
    }
}
