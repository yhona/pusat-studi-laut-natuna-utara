<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;

class ScheduledTaskCommandLegacy extends BaseCommand
{
    protected $group = 'Automation';
    protected $name = 'task:run-20min';
    protected $description = 'Alias for task:run-15min';
    protected $usage = 'task:run-20min';

    public function run(array $params)
    {
        $command = new ScheduledTaskCommand($this->logger, $this->commands);
        return $command->run($params);
    }
}
