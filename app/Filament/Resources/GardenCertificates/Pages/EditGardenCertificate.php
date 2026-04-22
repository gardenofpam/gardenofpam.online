<?php

namespace App\Filament\Resources\GardenCertificates\Pages;

use App\Filament\Resources\GardenCertificates\GardenCertificateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGardenCertificate extends EditRecord
{
    protected static string $resource = GardenCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
