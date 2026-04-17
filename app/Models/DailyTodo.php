<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTodo extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'item_order',
        'task',
        'is_done',
    ];

    protected $casts = [
        'date' => 'date',
        'is_done' => 'boolean',
    ];
}
