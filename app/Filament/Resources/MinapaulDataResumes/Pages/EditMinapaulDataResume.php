<?php

namespace App\Filament\Resources\MinapaulDataResumes\Pages;

use App\Filament\Resources\MinapaulDataResumes\MinapaulDataResumeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMinapaulDataResume extends EditRecord
{
    protected static string $resource = MinapaulDataResumeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
