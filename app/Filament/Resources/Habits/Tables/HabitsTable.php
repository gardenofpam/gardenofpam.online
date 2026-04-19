<?php

namespace App\Filament\Resources\Habits\Tables;

use App\Models\DailyTodo;
use App\Models\Habit;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;

class HabitsTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('date', 'desc')
            ->poll('750ms')
            ->recordUrl(null)
            ->columns([
                TextColumn::make('date')
                    ->label('Date')
                    ->date()
                    ->url(fn (Habit $record): string => route('filament.admin.resources.daily-todos.index', [
                        'date' => $record->date?->toDateString(),
                    ]))
                    ->sortable(),
                TextInputColumn::make('wakeup_time')
                    ->label('Wakeup Time')
                    ->type('time')
                    ->placeholder('HH:MM')
                    ->rules(['nullable', 'date_format:H:i']),
                CheckboxColumn::make('mind_20')
                    ->label('Mind (20 min)')
                    ->alignCenter(),
                CheckboxColumn::make('move_20')
                    ->label('Move (20 min)')
                    ->alignCenter(),
                CheckboxColumn::make('grow_20')
                    ->label('Grow (20 min)')
                    ->alignCenter(),
                TextColumn::make('ninety_ninety_one_seconds')
                    ->label('90/90')
                    ->alignCenter()
                    ->badge()
                    ->color(fn (Habit $record): string => $record->focus_timer_started_at ? 'danger' : 'success')
                    ->formatStateUsing(function ($state, Habit $record): string {
                        $seconds = (int) $state;

                        if ($record->focus_timer_started_at) {
                            $seconds += Carbon::parse($record->focus_timer_started_at)->diffInSeconds(now());
                        }

                        return ($record->focus_timer_started_at ? 'Stop: ' : 'Start: ') . gmdate('H:i:s', $seconds);
                    })
                    ->action(function (Habit $record): void {
                        if ($record->focus_timer_started_at) {
                            $elapsedSeconds = Carbon::parse($record->focus_timer_started_at)->diffInSeconds(now());

                            $record->update([
                                'ninety_ninety_one_seconds' => ((int) $record->ninety_ninety_one_seconds) + $elapsedSeconds,
                                'focus_timer_started_at' => null,
                            ]);

                            return;
                        }

                        $record->update([
                            'focus_timer_started_at' => now(),
                        ]);
                    }),
                TextInputColumn::make('focus_project')
                    ->label('1 Focus')
                    ->alignCenter()
                    ->placeholder('Your #1 project focus')
                    ->rules(['nullable', 'string', 'max:255']),
                CheckboxColumn::make('five_to_do')
                    ->label('5 To Do')
                    ->disabled()
                    ->alignCenter()
                    ->getStateUsing(function (Habit $record): bool {
                        $dailyTodos = DailyTodo::query()
                            ->whereDate('date', $record->date)
                            ->count();

                        if ($dailyTodos < 5) {
                            return false;
                        }

                        return DailyTodo::query()
                            ->whereDate('date', $record->date)
                            ->where('is_done', true)
                            ->count() === 5;
                    }),
                CheckboxColumn::make('wind_workout')
                    ->label('Workout')
                    ->alignCenter(),
            ])
            ->recordActions([]);
    }
}
