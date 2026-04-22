<?php

namespace App\Filament\Resources\GardenResumes\Pages;

use App\Filament\Resources\GardenResumes\GardenResumeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGardenResume extends EditRecord
{
    protected static string $resource = GardenResumeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
