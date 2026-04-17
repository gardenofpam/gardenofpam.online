<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Habit extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'wakeup_time',
        'mind_20',
        'move_20',
        'grow_20',
        'ninety_ninety_one_seconds',
        'focus_project',
        'wind_workout',
        'focus_timer_started_at',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'mind_20' => 'boolean',
        'move_20' => 'boolean',
        'grow_20' => 'boolean',
        'wind_workout' => 'boolean',
        'focus_timer_started_at' => 'datetime',
    ];

    public function isCompleted(): bool
    {
        return $this->mind_20 && $this->move_20 && $this->grow_20;
    }

    public function getCompletedCountAttribute(): int
    {
        return (int) $this->mind_20 + (int) $this->move_20 + (int) $this->grow_20;
    }
}
