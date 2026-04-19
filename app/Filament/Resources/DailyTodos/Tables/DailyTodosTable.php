<?php

namespace App\Filament\Resources\DailyTodos\Tables;

use App\Support\TrackingDate;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;

class DailyTodosTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->whereDate('date', TrackingDate::resolve()))
            ->defaultSort('item_order')
            ->paginated(false)
            ->recordUrl(null)
            ->columns([
                TextColumn::make('date')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('item_order')
                    ->label('#')
                    ->alignCenter(),
                TextInputColumn::make('task')
                    ->label('To Do')
                    ->placeholder('Enter your task')
                    ->rules(['nullable', 'string', 'max:255']),
                CheckboxColumn::make('is_done')
                    ->label('Done')
                    ->alignCenter(),
            ])
            ->recordActions([]);
    }
}
