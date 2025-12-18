<?php

namespace App\Services;

use App\Models\Schedule;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SchedulerService
{
    public function runDueSchedules(): void
    {
        $schedules = Schedule::where('enabled', true)
            ->where(function ($query) {
                $query->whereNull('last_run_at')
                    ->orWhere('last_run_at', '<=', DB::raw('DATE_SUB(NOW(), INTERVAL interval_minutes MINUTE)'));
            })->get();

        foreach ($schedules as $schedule) {
            Artisan::call($schedule->command);

            $schedule->last_run_at = now();
            $schedule->save();
        }
            
    }
}