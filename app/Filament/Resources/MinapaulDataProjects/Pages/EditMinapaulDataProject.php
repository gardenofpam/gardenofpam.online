<?php

namespace App\Filament\Resources\MinapaulDataProjects\Pages;

use App\Filament\Resources\MinapaulDataProjects\MinapaulDataProjectResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMinapaulDataProject extends EditRecord
{
    protected static string $resource = MinapaulDataProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
