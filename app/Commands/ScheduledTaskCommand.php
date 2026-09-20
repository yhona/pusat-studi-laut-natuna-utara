<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Services\CronMaintenanceService;

class ScheduledTaskCommand extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Automation';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'task:run-15min';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Executes periodic 15-minute maintenance, email queue dispatch, and cache warmup.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'task:run-15min';

    /**
     * Actually run the command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        CLI::write('[CRON 15-MIN] Memulai rutinitas otomatisasi pemeliharaan...', 'yellow');

        try {
            $service = new CronMaintenanceService();
            $result  = $service->execute();

            foreach ($result['tasks'] as $t) {
                CLI::write("  -> {$t}", 'green');
            }

            CLI::write("[CRON 15-MIN] " . $result['message'], 'light_cyan');
            CLI::write('[CRON 15-MIN] Selesai pada: ' . $result['last_run_human'], 'green');
        } catch (\Throwable $e) {
            CLI::error('[CRON 15-MIN ERROR] ' . $e->getMessage());
        }
    }
}
