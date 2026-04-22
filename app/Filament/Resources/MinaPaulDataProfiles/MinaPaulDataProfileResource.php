<?php

namespace App\Filament\Resources\MinaPaulDataProfiles;

use App\Filament\Resources\MinaPaulDataProfiles\Pages\CreateMinaPaulDataProfile;
use App\Filament\Resources\MinaPaulDataProfiles\Pages\EditMinaPaulDataProfile;
use App\Filament\Resources\MinaPaulDataProfiles\Pages\ListMinaPaulDataProfiles;
use App\Filament\Resources\Profiles\Schemas\ProfileForm;
use App\Filament\Resources\Profiles\Tables\ProfilesTable;
use App\Models\Profile;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class MinaPaulDataProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?int $navigationSort = 4;

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-user-circle';
    }

    public static function getNavigationLabel(): string
    {
        return 'General Page Content';
    }

    public static function getModelLabel(): string
    {
        return 'MinaPaulData Profile';
    }

    public static function getPluralModelLabel(): string
    {
        return 'MinaPaulData Profiles';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'MinapaulData CMS';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components(ProfileForm::schemaForNiche('minapauldata'));
    }

    public static function table(Table $table): Table
    {
        return ProfilesTable::table($table)
            ->modifyQueryUsing(fn ($query) => $query->where('niche', 'minapauldata'));
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListMinaPaulDataProfiles::route('/'),
            'create' => CreateMinaPaulDataProfile::route('/create'),
            'edit'   => EditMinaPaulDataProfile::route('/{record}/edit'),
        ];
    }
}
