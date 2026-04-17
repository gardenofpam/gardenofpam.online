<?php

namespace App\Filament\Resources\Habits\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;

class HabitForm
{
    public static function schema(): array
    {
        return [
            Section::make('5AM Club 20/20/20 Daily Checklist')
                ->schema([
                    DatePicker::make('date')
                        ->default(today())
                        ->native(false)
                        ->required(),

                    Toggle::make('mind_20')
                        ->label('Mind (20 min)')
                        ->helperText('Reflection, prayer, or meditation.')
                        ->default(false),
                    Toggle::make('move_20')
                        ->label('Move (20 min)')
                        ->helperText('Exercise to activate your body.')
                        ->default(false),
                    Toggle::make('grow_20')
                        ->label('Grow (20 min)')
                        ->helperText('Read or learn to develop skills.')
                        ->default(false),
                    Textarea::make('notes')
                        ->rows(3)
                        ->columnSpanFull(),
                ])->columns(2),
        ];
    }
}