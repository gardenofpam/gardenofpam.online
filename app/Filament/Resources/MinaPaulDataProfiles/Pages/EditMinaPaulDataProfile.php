<?php

namespace App\Filament\Resources\MinaPaulDataProfiles\Pages;

use App\Filament\Resources\MinaPaulDataProfiles\MinaPaulDataProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMinaPaulDataProfile extends EditRecord
{
    protected static string $resource = MinaPaulDataProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
