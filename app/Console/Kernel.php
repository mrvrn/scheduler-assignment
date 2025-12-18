<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    // Since this project was created using Laravel 12, schedule doesn't use this file.
    // The scheduling is done in routes/console.php.
    // However, since this was mentioned in the instructions, I'm leaving the method here commented out.
    // protected function schedule(Schedule $schedule)
    // {
    //     $schedule->command('app:run-schedules')->everyMinute();
    // }

    // protected function commands()
    // {
    //     $this->load(__DIR__.'/Commands');

    //     require base_path('routes/console.php');
    // }
}