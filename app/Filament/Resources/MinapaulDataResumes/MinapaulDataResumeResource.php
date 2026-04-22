<?php

namespace App\Filament\Resources\MinapaulDataResumes;

use App\Filament\Resources\MinapaulDataResumes\Pages\CreateMinapaulDataResume;
use App\Filament\Resources\MinapaulDataResumes\Pages\EditMinapaulDataResume;
use App\Filament\Resources\MinapaulDataResumes\Pages\ListMinapaulDataResumes;
use App\Filament\Resources\Resumes\Schemas\ResumeForm;
use App\Filament\Resources\Resumes\Tables\ResumesTable;
use App\Models\Resume;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MinapaulDataResumeResource extends Resource
{
    protected static ?string $model = Resume::class;
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components(ResumeForm::schemaForNiche('minapauldata'));
    }

    public static function table(Table $table): Table
    {
        return ResumesTable::table($table)
            ->modifyQueryUsing(fn (Builder $query) => $query->where('niche', 'minapauldata'));
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-document-text';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'MinapaulData CMS';
    }

    public static function getNavigationLabel(): string
    {
        return 'Resume / CV Editor';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('niche', 'minapauldata');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMinapaulDataResumes::route('/'),
            'create' => CreateMinapaulDataResume::route('/create'),
            'edit' => EditMinapaulDataResume::route('/{record}/edit'),
        ];
    }
}
