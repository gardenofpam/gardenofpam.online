<?php

namespace App\Filament\Resources\MinapaulDataCertificates\Pages;

use App\Filament\Resources\MinapaulDataCertificates\MinapaulDataCertificateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMinapaulDataCertificate extends EditRecord
{
    protected static string $resource = MinapaulDataCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
