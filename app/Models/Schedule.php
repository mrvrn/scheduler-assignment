<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';
    protected $fillable = [
        'name',
        'command',
        'interval_minutes',
        'last_run_at',
        'enabled',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'last_run_at' => 'datetime',
        'interval_minutes' => 'integer',
    ];
}
