<?php

namespace App\Filament\Resources\MinaPaulDataProfiles\Pages;

use App\Filament\Resources\MinaPaulDataProfiles\MinaPaulDataProfileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMinaPaulDataProfiles extends ListRecords
{
    protected static string $resource = MinaPaulDataProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
