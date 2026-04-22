<?php

namespace App\Filament\Resources\GardenProjects\Pages;

use App\Filament\Resources\GardenProjects\GardenProjectResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGardenProject extends EditRecord
{
    protected static string $resource = GardenProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
