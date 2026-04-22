<?php

namespace App\Filament\Resources\MinapaulDataProjects\Pages;

use App\Filament\Resources\MinapaulDataProjects\MinapaulDataProjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMinapaulDataProjects extends ListRecords
{
    protected static string $resource = MinapaulDataProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
