<?php

namespace App\Filament\Resources\CpeminaProjects;

use App\Filament\Resources\CpeminaProjects\Pages\CreateCpeminaProject;
use App\Filament\Resources\CpeminaProjects\Pages\EditCpeminaProject;
use App\Filament\Resources\CpeminaProjects\Pages\ListCpeminaProjects;
use App\Filament\Resources\Projects\Schemas\ProjectForm;
use App\Filament\Resources\Projects\Tables\ProjectsTable;
use App\Models\Project;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CpeminaProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components(ProjectForm::schemaForNiche('cpemina'));
    }

    public static function table(Table $table): Table
    {
        return ProjectsTable::table($table)
            ->modifyQueryUsing(fn (Builder $query) => $query->where('niche', 'cpemina'));
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-folder-open';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'CPEMina CMS';
    }

    public static function getNavigationLabel(): string
    {
        return 'Portfolio Management';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('niche', 'cpemina');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCpeminaProjects::route('/'),
            'create' => CreateCpeminaProject::route('/create'),
            'edit' => EditCpeminaProject::route('/{record}/edit'),
        ];
    }
}
