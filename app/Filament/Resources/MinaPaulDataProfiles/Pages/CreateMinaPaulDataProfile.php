<?php

namespace App\Filament\Resources\MinaPaulDataProfiles\Pages;

use App\Filament\Resources\MinaPaulDataProfiles\MinaPaulDataProfileResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMinaPaulDataProfile extends CreateRecord
{
    protected static string $resource = MinaPaulDataProfileResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['niche'] = 'minapauldata';

        return $data;
    }
}
