<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// When using a newer version of Laravel, you might need to schedule commands here instead.
// use Illuminate\Support\Facades\Schedule;
// Schedule::command('app:run-schedules')->everyMinute();
