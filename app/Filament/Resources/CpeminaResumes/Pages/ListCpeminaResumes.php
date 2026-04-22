<?php

namespace App\Filament\Resources\CpeminaResumes\Pages;

use App\Filament\Resources\CpeminaResumes\CpeminaResumeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCpeminaResumes extends ListRecords
{
    protected static string $resource = CpeminaResumeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
