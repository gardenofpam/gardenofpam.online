<?php

namespace App\Filament\Resources\Resumes;

use App\Filament\Resources\Resumes\Pages\CreateResume;
use App\Filament\Resources\Resumes\Pages\EditResume;
use App\Filament\Resources\Resumes\Pages\ListResumes;
use App\Filament\Resources\Resumes\Schemas\ResumeForm;
use App\Filament\Resources\Resumes\Tables\ResumesTable;
use App\Models\Resume;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ResumeResource extends Resource
{
    protected static ?string $model = Resume::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?int $navigationSort = 4;

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-document-text';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Portfolio';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components(ResumeForm::schema());
    }

    public static function table(Table $table): Table
    {
        return ResumesTable::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListResumes::route('/'),
            'create' => CreateResume::route('/create'),
            'edit'   => EditResume::route('/{record}/edit'),
        ];
    }
}