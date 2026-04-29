<?php

namespace App\Filament\Resources\DailyTodos;

use App\Filament\Resources\DailyTodos\Pages\ListDailyTodos;
use App\Filament\Resources\DailyTodos\Tables\DailyTodosTable;
use App\Models\DailyTodo;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class DailyTodoResource extends Resource
{
    protected static ?string $model = DailyTodo::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?int $navigationSort = 2;

    public static function canAccess(): bool
    {
        return false;
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-list-bullet';
    }

    public static function getNavigationGroup(): ?string
    {
        return '5AM Club';
    }

    public static function getNavigationLabel(): string
    {
        return '5 To Do List';
    }

    public static function getModelLabel(): string
    {
        return 'Daily To Do';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Daily To Dos';
    }

    public static function table(Table $table): Table
    {
        return DailyTodosTable::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDailyTodos::route('/'),
        ];
    }
}
