<?php

namespace App\Filament\Resources\CpeminaCertificates\Pages;

use App\Filament\Resources\CpeminaCertificates\CpeminaCertificateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCpeminaCertificates extends ListRecords
{
    protected static string $resource = CpeminaCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
