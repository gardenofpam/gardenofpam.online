<?php

namespace App\Filament\Resources\GardenProfiles\Pages;

use App\Filament\Resources\GardenProfiles\GardenProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGardenProfile extends EditRecord
{
    protected static string $resource = GardenProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
