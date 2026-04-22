<?php

namespace App\Filament\Resources\GardenResumes\Pages;

use App\Filament\Resources\GardenResumes\GardenResumeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGardenResumes extends ListRecords
{
    protected static string $resource = GardenResumeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
