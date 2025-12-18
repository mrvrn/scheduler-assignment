<?php

namespace Tests\Feature;

use App\Models\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScheduleControllerTest extends TestCase
{
     use RefreshDatabase;

    public function test_index_returns_schedules(): void
    {
        Schedule::create([
            'name' => 'A',
            'command' => 'app:log-timestamp',
            'interval_minutes' => 5,
            'enabled' => true,
            'last_run_at' => null,
        ]);

        $this->getJson('/api/schedules')
            ->assertOk()
            ->assertJsonCount(1);
    }

    public function test_show_returns_a_schedule(): void
    {
        $schedule = Schedule::create([
            'name' => 'Show me',
            'command' => 'app:log-timestamp',
            'interval_minutes' => 5,
            'enabled' => true,
            'last_run_at' => null,
        ]);

        $this->getJson("/api/schedules/{$schedule->id}")
            ->assertOk()
            ->assertJsonPath('id', $schedule->id)
            ->assertJsonPath('name', 'Show me');
    }

    public function test_store_creates_a_schedule(): void
    {
        $this->postJson('/api/schedules', [
            'name' => 'Created',
            'command' => 'app:log-timestamp',
            'interval_minutes' => 5,
            'enabled' => true,
        ])
        ->assertCreated()
        ->assertJsonPath('name', 'Created')
        ->assertJsonPath('command', 'app:log-timestamp');

        $this->assertDatabaseHas('schedules', [
            'name' => 'Created',
            'command' => 'app:log-timestamp',
            'interval_minutes' => 5,
            'enabled' => 1,
        ]);
    }

    public function test_store_validates_required_fields(): void
    {
        $this->postJson('/api/schedules', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'command']);
    }

    public function test_update_updates_a_schedule(): void
    {
        $schedule = Schedule::create([
            'name' => 'Before',
            'command' => 'app:log-timestamp',
            'interval_minutes' => 5,
            'enabled' => true,
            'last_run_at' => null,
        ]);

        $this->putJson("/api/schedules/{$schedule->id}", [
            'name' => 'After',
            'command' => 'app:log-timestamp',
            'interval_minutes' => 10,
            'enabled' => false,
        ])
        ->assertOk()
        ->assertJsonPath('name', 'After')
        ->assertJsonPath('interval_minutes', 10)
        ->assertJsonPath('enabled', false);

        $this->assertDatabaseHas('schedules', [
            'id' => $schedule->id,
            'name' => 'After',
            'interval_minutes' => 10,
            'enabled' => 0,
        ]);
    }

    public function test_destroy_deletes_a_schedule(): void
    {
        $schedule = Schedule::create([
            'name' => 'Delete me',
            'command' => 'app:log-timestamp',
            'interval_minutes' => 5,
            'enabled' => true,
            'last_run_at' => null,
        ]);

        $this->deleteJson("/api/schedules/{$schedule->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('schedules', [
            'id' => $schedule->id,
        ]);
    }
}
