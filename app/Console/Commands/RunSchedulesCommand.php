<?php

namespace App\Console\Commands;

use App\Services\SchedulerService;
use Illuminate\Console\Command;
use Nette\Schema\Schema;

class RunSchedulesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-schedules';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs due schedules';

    /**
     * Execute the console command.
     */
    public function handle(SchedulerService $scheduler_service)
    {
        $scheduler_service->runDueSchedules();
    }
}
