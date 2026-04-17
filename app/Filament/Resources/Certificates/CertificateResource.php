<?php

namespace App\Filament\Resources\Certificates;

use App\Filament\Resources\Certificates\Pages\CreateCertificate;
use App\Filament\Resources\Certificates\Pages\EditCertificate;
use App\Filament\Resources\Certificates\Pages\ListCertificates;
use App\Filament\Resources\Certificates\Schemas\CertificateForm;
use App\Filament\Resources\Certificates\Tables\CertificatesTable;
use App\Models\Certificate;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class CertificateResource extends Resource
{
    protected static ?string $model = Certificate::class;

    protected static ?int $navigationSort = 3;

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-academic-cap';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Portfolio';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components(CertificateForm::schema());
    }

    public static function table(Table $table): Table
    {
        return CertificatesTable::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListCertificates::route('/'),
            'create' => CreateCertificate::route('/create'),
            'edit'   => EditCertificate::route('/{record}/edit'),
        ];
    }
}