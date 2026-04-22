<?php

namespace App\Filament\Resources\MinapaulDataCertificates\Pages;

use App\Filament\Resources\MinapaulDataCertificates\MinapaulDataCertificateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMinapaulDataCertificates extends ListRecords
{
    protected static string $resource = MinapaulDataCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
