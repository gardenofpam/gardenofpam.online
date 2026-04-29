<?php

namespace App\Filament\Resources\Habits;

use App\Filament\Resources\Habits\Pages\ListHabits;
use App\Filament\Resources\Habits\Schemas\HabitForm;
use App\Filament\Resources\Habits\Tables\HabitsTable;
use App\Models\Habit;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class HabitResource extends Resource
{
    protected static ?string $model = Habit::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return false;
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-clock';
    }

    public static function getNavigationGroup(): ?string
    {
        return '5AM Club';
    }

    public static function getNavigationLabel(): string
    {
        return '20/20/20 Checklist';
    }

    public static function getModelLabel(): string
    {
        return 'Daily Checklist';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Daily Checklists';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components(HabitForm::schema());
    }

    public static function table(Table $table): Table
    {
        return HabitsTable::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListHabits::route('/'),
        ];
    }
}
