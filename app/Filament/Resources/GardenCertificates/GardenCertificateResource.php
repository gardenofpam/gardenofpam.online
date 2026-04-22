<?php

namespace App\Filament\Resources\GardenCertificates;

use App\Filament\Resources\GardenCertificates\Pages\CreateGardenCertificate;
use App\Filament\Resources\GardenCertificates\Pages\EditGardenCertificate;
use App\Filament\Resources\GardenCertificates\Pages\ListGardenCertificates;
use App\Filament\Resources\Certificates\Schemas\CertificateForm;
use App\Filament\Resources\Certificates\Tables\CertificatesTable;
use App\Models\Certificate;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class GardenCertificateResource extends Resource
{
    protected static ?string $model = Certificate::class;
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->components(CertificateForm::schemaForNiche('gardenofpam'));
    }

    public static function table(Table $table): Table
    {
        return CertificatesTable::table($table)
            ->modifyQueryUsing(fn (Builder $query) => $query->where('niche', 'gardenofpam'));
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-academic-cap';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'GardenOfPam CMS';
    }

    public static function getNavigationLabel(): string
    {
        return 'Certificates / Achievements';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('niche', 'gardenofpam');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGardenCertificates::route('/'),
            'create' => CreateGardenCertificate::route('/create'),
            'edit' => EditGardenCertificate::route('/{record}/edit'),
        ];
    }
}
