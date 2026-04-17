<?php

namespace App\Filament\Resources\CpeminaProfiles;

use App\Filament\Resources\CpeminaProfiles\Pages\CreateCpeminaProfile;
use App\Filament\Resources\CpeminaProfiles\Pages\EditCpeminaProfile;
use App\Filament\Resources\CpeminaProfiles\Pages\ListCpeminaProfiles;
use App\Filament\Resources\Profiles\Schemas\ProfileForm;
use App\Filament\Resources\Profiles\Tables\ProfilesTable;
use App\Models\Profile;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class CpeminaProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?int $navigationSort = 2;

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-user-circle';
    }

    public static function getNavigationLabel(): string
    {
        return 'CPEmina Profile';
    }

    public static function getModelLabel(): string
    {
        return 'CPEmina Profile';
    }

    public static function getPluralModelLabel(): string
    {
        return 'CPEmina Profiles';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Portfolio';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components(ProfileForm::schemaForNiche('cpemina'));
    }

    public static function table(Table $table): Table
    {
        return ProfilesTable::table($table)
            ->modifyQueryUsing(fn ($query) => $query->where('niche', 'cpemina'));
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListCpeminaProfiles::route('/'),
            'create' => CreateCpeminaProfile::route('/create'),
            'edit'   => EditCpeminaProfile::route('/{record}/edit'),
        ];
    }
}
