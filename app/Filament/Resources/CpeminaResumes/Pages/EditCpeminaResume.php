<?php

namespace App\Filament\Resources\CpeminaResumes\Pages;

use App\Filament\Resources\CpeminaResumes\CpeminaResumeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCpeminaResume extends EditRecord
{
    protected static string $resource = CpeminaResumeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
