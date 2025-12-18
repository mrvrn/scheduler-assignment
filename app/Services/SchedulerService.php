<?php

namespace App\Services;

use App\Models\Schedule;
use Illuminate\Support\Facades\Artisan;

class SchedulerService
{
    public function runDueSchedules(): void
    {
        $schedules = Schedule::where('enabled', true)->get();

        foreach ($schedules as $schedule) {
            $schedule_due = is_null($schedule->last_run_at) ||
                $schedule->last_run_at->copy()->addMinutes($schedule->interval_minutes)->lte(now());

            if (!$schedule_due) {
                continue;
            }

            Artisan::call($schedule->command);

            $schedule->last_run_at = now();
            $schedule->save();
        }
            
    }
}