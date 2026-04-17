<?php

namespace App\Filament\Resources\GardenProfiles;

use App\Filament\Resources\GardenProfiles\Pages\CreateGardenProfile;
use App\Filament\Resources\GardenProfiles\Pages\EditGardenProfile;
use App\Filament\Resources\GardenProfiles\Pages\ListGardenProfiles;
use App\Filament\Resources\Profiles\Schemas\ProfileForm;
use App\Filament\Resources\Profiles\Tables\ProfilesTable;
use App\Models\Profile;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class GardenProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?int $navigationSort = 1;

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-user-circle';
    }

    public static function getNavigationLabel(): string
    {
        return 'Garden of Pam Profile';
    }

    public static function getModelLabel(): string
    {
        return 'Garden of Pam Profile';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Garden of Pam Profiles';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Portfolio';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components(ProfileForm::schemaForNiche('gardenofpam'));
    }

    public static function table(Table $table): Table
    {
        return ProfilesTable::table($table)
            ->modifyQueryUsing(fn ($query) => $query->where('niche', 'gardenofpam'));
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListGardenProfiles::route('/'),
            'create' => CreateGardenProfile::route('/create'),
            'edit'   => EditGardenProfile::route('/{record}/edit'),
        ];
    }
}
