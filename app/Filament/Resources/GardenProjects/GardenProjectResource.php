<?php

namespace App\Filament\Resources\GardenProjects;

use App\Filament\Resources\GardenProjects\Pages\CreateGardenProject;
use App\Filament\Resources\GardenProjects\Pages\EditGardenProject;
use App\Filament\Resources\GardenProjects\Pages\ListGardenProjects;
use App\Filament\Resources\Projects\Schemas\ProjectForm;
use App\Filament\Resources\Projects\Tables\ProjectsTable;
use App\Models\Project;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class GardenProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components(ProjectForm::schemaForNiche('gardenofpam'));
    }

    public static function table(Table $table): Table
    {
        return ProjectsTable::table($table)
            ->modifyQueryUsing(fn (Builder $query) => $query->where('niche', 'gardenofpam'));
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-folder-open';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'GardenOfPam CMS';
    }

    public static function getNavigationLabel(): string
    {
        return 'Portfolio Management';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('niche', 'gardenofpam');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGardenProjects::route('/'),
            'create' => CreateGardenProject::route('/create'),
            'edit' => EditGardenProject::route('/{record}/edit'),
        ];
    }
}
