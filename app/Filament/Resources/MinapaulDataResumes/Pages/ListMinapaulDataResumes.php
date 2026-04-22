<?php

namespace App\Filament\Resources\MinapaulDataResumes\Pages;

use App\Filament\Resources\MinapaulDataResumes\MinapaulDataResumeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMinapaulDataResumes extends ListRecords
{
    protected static string $resource = MinapaulDataResumeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
