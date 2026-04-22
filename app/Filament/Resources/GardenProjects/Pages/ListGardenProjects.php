<?php

namespace App\Filament\Resources\GardenProjects\Pages;

use App\Filament\Resources\GardenProjects\GardenProjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGardenProjects extends ListRecords
{
    protected static string $resource = GardenProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
