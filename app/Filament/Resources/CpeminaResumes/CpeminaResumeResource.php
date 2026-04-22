<?php

namespace App\Filament\Resources\CpeminaResumes;

use App\Filament\Resources\CpeminaResumes\Pages\CreateCpeminaResume;
use App\Filament\Resources\CpeminaResumes\Pages\EditCpeminaResume;
use App\Filament\Resources\CpeminaResumes\Pages\ListCpeminaResumes;
use App\Filament\Resources\Resumes\Schemas\ResumeForm;
use App\Filament\Resources\Resumes\Tables\ResumesTable;
use App\Models\Resume;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CpeminaResumeResource extends Resource
{
    protected static ?string $model = Resume::class;
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components(ResumeForm::schemaForNiche('cpemina'));
    }

    public static function table(Table $table): Table
    {
        return ResumesTable::table($table)
            ->modifyQueryUsing(fn (Builder $query) => $query->where('niche', 'cpemina'));
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-document-text';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'CPEMina CMS';
    }

    public static function getNavigationLabel(): string
    {
        return 'Resume / CV Editor';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('niche', 'cpemina');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCpeminaResumes::route('/'),
            'create' => CreateCpeminaResume::route('/create'),
            'edit' => EditCpeminaResume::route('/{record}/edit'),
        ];
    }
}
