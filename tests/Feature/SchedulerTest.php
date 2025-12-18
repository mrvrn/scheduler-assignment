<?php

namespace Tests\Feature;

use App\Models\Schedule;
use App\Services\SchedulerService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class SchedulerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_scheduler(): void
    {
        $schedule = Schedule::create([
            'name' => 'Test Schedule',
            'command' => 'app:log-timestamp',
            'interval_minutes' => 5,
            'last_run_at' => null,
            'enabled' => true,
        ]);

        Artisan::shouldReceive('call')
            ->once()
            ->with('app:log-timestamp')
            ->andReturn(0);

        app(SchedulerService::class)->runDueSchedules();

        $schedule->refresh();
        $this->assertNotNull($schedule->last_run_at);
    }
}
