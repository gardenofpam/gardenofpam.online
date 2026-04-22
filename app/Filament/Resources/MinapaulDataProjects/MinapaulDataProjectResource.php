<?php

namespace App\Filament\Resources\MinapaulDataProjects;

use App\Filament\Resources\MinapaulDataProjects\Pages\CreateMinapaulDataProject;
use App\Filament\Resources\MinapaulDataProjects\Pages\EditMinapaulDataProject;
use App\Filament\Resources\MinapaulDataProjects\Pages\ListMinapaulDataProjects;
use App\Filament\Resources\Projects\Schemas\ProjectForm;
use App\Filament\Resources\Projects\Tables\ProjectsTable;
use App\Models\Project;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MinapaulDataProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components(ProjectForm::schemaForNiche('minapauldata'));
    }

    public static function table(Table $table): Table
    {
        return ProjectsTable::table($table)
            ->modifyQueryUsing(fn (Builder $query) => $query->where('niche', 'minapauldata'));
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-folder-open';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'MinapaulData CMS';
    }

    public static function getNavigationLabel(): string
    {
        return 'Portfolio Management';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('niche', 'minapauldata');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMinapaulDataProjects::route('/'),
            'create' => CreateMinapaulDataProject::route('/create'),
            'edit' => EditMinapaulDataProject::route('/{record}/edit'),
        ];
    }
}
