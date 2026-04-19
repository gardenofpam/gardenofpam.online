<?php

namespace App\Filament\Resources\DailyTodos\Pages;

use App\Filament\Resources\DailyTodos\DailyTodoResource;
use App\Support\TrackingDate;
use App\Models\DailyTodo;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Carbon;

class ListDailyTodos extends ListRecords
{
    protected static string $resource = DailyTodoResource::class;

    public function mount(): void
    {
        $selectedDate = TrackingDate::resolve();

        foreach (range(1, 5) as $order) {
            DailyTodo::firstOrCreate(
                ['date' => $selectedDate, 'item_order' => $order],
                ['task' => null, 'is_done' => false]
            );
        }

        parent::mount();
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTitle(): string
    {
        return '5 To Do List - ' . Carbon::parse(TrackingDate::resolve())->format('M j, Y');
    }
}
