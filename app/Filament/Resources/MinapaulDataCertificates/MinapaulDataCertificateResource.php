<?php

namespace App\Filament\Resources\MinapaulDataCertificates;

use App\Filament\Resources\MinapaulDataCertificates\Pages\CreateMinapaulDataCertificate;
use App\Filament\Resources\MinapaulDataCertificates\Pages\EditMinapaulDataCertificate;
use App\Filament\Resources\MinapaulDataCertificates\Pages\ListMinapaulDataCertificates;
use App\Filament\Resources\Certificates\Schemas\CertificateForm;
use App\Filament\Resources\Certificates\Tables\CertificatesTable;
use App\Models\Certificate;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MinapaulDataCertificateResource extends Resource
{
    protected static ?string $model = Certificate::class;
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->components(CertificateForm::schemaForNiche('minapauldata'));
    }

    public static function table(Table $table): Table
    {
        return CertificatesTable::table($table)
            ->modifyQueryUsing(fn (Builder $query) => $query->where('niche', 'minapauldata'));
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-academic-cap';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'MinapaulData CMS';
    }

    public static function getNavigationLabel(): string
    {
        return 'Certificates / Achievements';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('niche', 'minapauldata');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMinapaulDataCertificates::route('/'),
            'create' => CreateMinapaulDataCertificate::route('/create'),
            'edit' => EditMinapaulDataCertificate::route('/{record}/edit'),
        ];
    }
}
