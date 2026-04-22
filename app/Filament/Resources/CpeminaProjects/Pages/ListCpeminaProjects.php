<?php

namespace App\Filament\Resources\CpeminaProjects\Pages;

use App\Filament\Resources\CpeminaProjects\CpeminaProjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCpeminaProjects extends ListRecords
{
    protected static string $resource = CpeminaProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
