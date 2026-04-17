<?php

namespace App\Filament\Resources\Profiles;

use App\Filament\Resources\Profiles\Pages\CreateProfile;
use App\Filament\Resources\Profiles\Pages\EditProfile;
use App\Filament\Resources\Profiles\Pages\ListProfiles;
use App\Filament\Resources\Profiles\Schemas\ProfileForm;
use App\Filament\Resources\Profiles\Tables\ProfilesTable;
use App\Models\Profile;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?int $navigationSort = 1;

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-user-circle';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Portfolio';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components(ProfileForm::schema());
    }

    public static function table(Table $table): Table
    {
        return ProfilesTable::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListProfiles::route('/'),
            'create' => CreateProfile::route('/create'),
            'edit'   => EditProfile::route('/{record}/edit'),
        ];
    }
}