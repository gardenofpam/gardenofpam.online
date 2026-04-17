<?php

namespace App\Filament\Resources\CpeminaProfiles\Pages;

use App\Filament\Resources\CpeminaProfiles\CpeminaProfileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCpeminaProfiles extends ListRecords
{
    protected static string $resource = CpeminaProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
