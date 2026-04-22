<?php

namespace App\Filament\Resources\GardenResumes;

use App\Filament\Resources\GardenResumes\Pages\CreateGardenResume;
use App\Filament\Resources\GardenResumes\Pages\EditGardenResume;
use App\Filament\Resources\GardenResumes\Pages\ListGardenResumes;
use App\Filament\Resources\Resumes\Schemas\ResumeForm;
use App\Filament\Resources\Resumes\Tables\ResumesTable;
use App\Models\Resume;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class GardenResumeResource extends Resource
{
    protected static ?string $model = Resume::class;
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components(ResumeForm::schemaForNiche('gardenofpam'));
    }

    public static function table(Table $table): Table
    {
        return ResumesTable::table($table)
            ->modifyQueryUsing(fn (Builder $query) => $query->where('niche', 'gardenofpam'));
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-document-text';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'GardenOfPam CMS';
    }

    public static function getNavigationLabel(): string
    {
        return 'Resume / CV Editor';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('niche', 'gardenofpam');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGardenResumes::route('/'),
            'create' => CreateGardenResume::route('/create'),
            'edit' => EditGardenResume::route('/{record}/edit'),
        ];
    }
}
