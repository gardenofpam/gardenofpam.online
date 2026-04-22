<?php

namespace App\Filament\Resources\GardenCertificates\Pages;

use App\Filament\Resources\GardenCertificates\GardenCertificateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGardenCertificates extends ListRecords
{
    protected static string $resource = GardenCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
