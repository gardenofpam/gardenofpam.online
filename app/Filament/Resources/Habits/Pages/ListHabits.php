<?php

namespace App\Filament\Resources\Habits\Pages;

use App\Filament\Resources\Habits\HabitResource;
use App\Models\Habit;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Schema;

class ListHabits extends ListRecords
{
    protected static string $resource = HabitResource::class;

    public function mount(): void
    {
        $habit = Habit::query()
            ->whereDate('date', today()->toDateString())
            ->first();

        if (! $habit) {
            $habit = new Habit();
            $habit->forceFill(array_merge(
                ['date' => today()->toDateString()],
                $this->getDefaultHabitAttributes(),
            ));
            $habit->save();
        }

        parent::mount();
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getDefaultHabitAttributes(): array
    {
        $attributes = [
            'mind_20' => false,
            'move_20' => false,
            'grow_20' => false,
        ];

        if (Schema::hasColumn('habits', 'name')) {
            $attributes['name'] = '20/20/20 Checklist';
        }

        if (Schema::hasColumn('habits', 'icon')) {
            $attributes['icon'] = 'heroicon-o-clock';
        }

        if (Schema::hasColumn('habits', 'color')) {
            $attributes['color'] = '#4A7C59';
        }

        if (Schema::hasColumn('habits', 'frequency')) {
            $attributes['frequency'] = 'daily';
        }

        if (Schema::hasColumn('habits', 'target_per_day')) {
            $attributes['target_per_day'] = 1;
        }

        if (Schema::hasColumn('habits', 'is_active')) {
            $attributes['is_active'] = true;
        }

        return $attributes;
    }
}
