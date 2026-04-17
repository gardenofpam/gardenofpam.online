<?php

namespace App\Filament\Resources\GardenProfiles\Pages;

use App\Filament\Resources\GardenProfiles\GardenProfileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGardenProfiles extends ListRecords
{
    protected static string $resource = GardenProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
