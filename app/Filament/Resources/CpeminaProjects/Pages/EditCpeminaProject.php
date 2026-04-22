<?php

namespace App\Filament\Resources\CpeminaProjects\Pages;

use App\Filament\Resources\CpeminaProjects\CpeminaProjectResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCpeminaProject extends EditRecord
{
    protected static string $resource = CpeminaProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
