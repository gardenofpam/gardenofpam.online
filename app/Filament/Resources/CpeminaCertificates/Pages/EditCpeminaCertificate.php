<?php

namespace App\Filament\Resources\CpeminaCertificates\Pages;

use App\Filament\Resources\CpeminaCertificates\CpeminaCertificateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCpeminaCertificate extends EditRecord
{
    protected static string $resource = CpeminaCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
