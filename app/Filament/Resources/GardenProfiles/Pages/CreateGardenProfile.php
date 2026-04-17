<?php

namespace App\Filament\Resources\GardenProfiles\Pages;

use App\Filament\Resources\GardenProfiles\GardenProfileResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGardenProfile extends CreateRecord
{
    protected static string $resource = GardenProfileResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['niche'] = 'gardenofpam';

        return $data;
    }
}
