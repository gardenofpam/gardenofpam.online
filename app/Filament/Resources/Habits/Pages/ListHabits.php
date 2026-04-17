<?php

namespace App\Filament\Resources\Habits\Pages;

use App\Filament\Resources\Habits\HabitResource;
use App\Models\Habit;
use Filament\Resources\Pages\ListRecords;

class ListHabits extends ListRecords
{
    protected static string $resource = HabitResource::class;

    public function mount(): void
    {
        Habit::firstOrCreate(
            ['date' => today()->toDateString()],
            ['mind_20' => false, 'move_20' => false, 'grow_20' => false]
        );

        parent::mount();
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
