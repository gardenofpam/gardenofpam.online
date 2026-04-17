<?php

namespace App\Filament\Resources\CpeminaProfiles\Pages;

use App\Filament\Resources\CpeminaProfiles\CpeminaProfileResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCpeminaProfile extends CreateRecord
{
    protected static string $resource = CpeminaProfileResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['niche'] = 'cpemina';

        return $data;
    }
}
