<?php

namespace App\Filament\Resources\CpeminaProfiles\Pages;

use App\Filament\Resources\CpeminaProfiles\CpeminaProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCpeminaProfile extends EditRecord
{
    protected static string $resource = CpeminaProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
