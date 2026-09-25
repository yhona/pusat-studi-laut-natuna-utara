<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class AppBackup extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Backup';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'app:backup';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Creates a compressed timestamped ZIP backup of the SQLite database and public uploads directory.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'app:backup';

    /**
     * Actually run the command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        CLI::write('====================================================', 'yellow');
        CLI::write('   NNSRC UMRAH — BACKUP DATABASE & MEDIA UPLOADS   ', 'yellow');
        CLI::write('====================================================', 'yellow');

        $backupDir = WRITEPATH . 'backups' . DIRECTORY_SEPARATOR;
        if (! is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $timestamp = date('Ymd_His');
        $zipFilename = 'nnsrc_backup_' . $timestamp . '.zip';
        $zipFilePath = $backupDir . $zipFilename;

        if (! class_exists('ZipArchive')) {
            CLI::error('PHP ZipArchive extension is not enabled on this system.');
            return;
        }

        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            CLI::error("Failed to create ZIP archive at: {$zipFilePath}");
            return;
        }

        $filesCount = 0;

        // 1. Backup SQLite Database
        $dbFile = WRITEPATH . 'database.sqlite';
        if (file_exists($dbFile)) {
            $zip->addFile($dbFile, 'database' . DIRECTORY_SEPARATOR . 'database.sqlite');
            $filesCount++;
            CLI::write('  [+] Archived database: writable/database.sqlite', 'green');
        } else {
            CLI::write('  [!] Notice: writable/database.sqlite not found.', 'red');
        }

        // 2. Backup Public Uploads Directory
        $uploadsDir = FCPATH . 'uploads';
        if (is_dir($uploadsDir)) {
            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($uploadsDir, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST
            );

            foreach ($iterator as $item) {
                $relativePath = 'uploads' . DIRECTORY_SEPARATOR . substr($item->getPathname(), strlen($uploadsDir) + 1);
                if ($item->isDir()) {
                    $zip->addEmptyDir($relativePath);
                } elseif ($item->isFile()) {
                    $zip->addFile($item->getPathname(), $relativePath);
                    $filesCount++;
                }
            }
            CLI::write('  [+] Archived directory: public/uploads/ recursively', 'green');
        } else {
            CLI::write('  [!] Notice: public/uploads directory does not exist yet.', 'light_gray');
        }

        // 3. Close & Save Archive
        $zip->close();

        if (file_exists($zipFilePath)) {
            $sizeInBytes = filesize($zipFilePath);
            $sizeFormatted = $this->formatBytes($sizeInBytes);

            CLI::newLine();
            CLI::write(">>> Backup completed successfully! <<<", 'green');
            CLI::write("  - Archive file: {$zipFilePath}", 'cyan');
            CLI::write("  - Total files : {$filesCount}", 'cyan');
            CLI::write("  - Archive size: {$sizeFormatted}", 'cyan');
            CLI::newLine();

            // 4. Housekeeping: Remove backups older than 30 days
            $this->cleanOldBackups($backupDir, 30);
        } else {
            CLI::error('Failed to verify created ZIP file.');
        }
    }

    /**
     * Remove backup files older than specified number of days.
     */
    private function cleanOldBackups(string $dir, int $days = 30): void
    {
        $cutoff = time() - ($days * 86400);
        $files = glob($dir . 'nnsrc_backup_*.zip');

        if ($files) {
            foreach ($files as $file) {
                if (filemtime($file) < $cutoff) {
                    unlink($file);
                    CLI::write('  [-] Pruned expired backup: ' . basename($file), 'light_gray');
                }
            }
        }
    }

    /**
     * Format bytes to human readable format.
     */
    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        }
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        }
        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' B';
    }
}
