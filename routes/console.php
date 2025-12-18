<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// In Laravel 12, scheduling commands is done in routes/console.php.
// So we schedule the command to run due schedules here.
Schedule::command('app:run-schedules')->everyMinute();
