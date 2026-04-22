<?php

namespace App\Filament\Resources\CpeminaCertificates;

use App\Filament\Resources\CpeminaCertificates\Pages\CreateCpeminaCertificate;
use App\Filament\Resources\CpeminaCertificates\Pages\EditCpeminaCertificate;
use App\Filament\Resources\CpeminaCertificates\Pages\ListCpeminaCertificates;
use App\Filament\Resources\Certificates\Schemas\CertificateForm;
use App\Filament\Resources\Certificates\Tables\CertificatesTable;
use App\Models\Certificate;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CpeminaCertificateResource extends Resource
{
    protected static ?string $model = Certificate::class;
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->components(CertificateForm::schemaForNiche('cpemina'));
    }

    public static function table(Table $table): Table
    {
        return CertificatesTable::table($table)
            ->modifyQueryUsing(fn (Builder $query) => $query->where('niche', 'cpemina'));
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-academic-cap';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'CPEMina CMS';
    }

    public static function getNavigationLabel(): string
    {
        return 'Certificates / Achievements';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('niche', 'cpemina');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCpeminaCertificates::route('/'),
            'create' => CreateCpeminaCertificate::route('/create'),
            'edit' => EditCpeminaCertificate::route('/{record}/edit'),
        ];
    }
}
