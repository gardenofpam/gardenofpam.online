<?php

namespace App\Filament\Resources\DailyTodos\Pages;

use App\Filament\Resources\DailyTodos\DailyTodoResource;
use App\Models\DailyTodo;
use Filament\Resources\Pages\ListRecords;

class ListDailyTodos extends ListRecords
{
    protected static string $resource = DailyTodoResource::class;

    public function mount(): void
    {
        foreach (range(1, 5) as $order) {
            DailyTodo::firstOrCreate(
                ['date' => today()->toDateString(), 'item_order' => $order],
                ['task' => null, 'is_done' => false]
            );
        }

        parent::mount();
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
