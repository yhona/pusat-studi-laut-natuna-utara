<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;

class ScheduledTaskCommandLegacy extends BaseCommand
{
    protected $group = 'Automation';
    protected $name = 'task:run-15min';
    protected $description = 'Legacy alias for task:run-20min';
    protected $usage = 'task:run-15min';

    public function run(array $params)
    {
        $command = new ScheduledTaskCommand($this->logger, $this->commands);
        return $command->run($params);
    }
}
