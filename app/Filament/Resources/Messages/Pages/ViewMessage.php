<?php

namespace App\Filament\Resources\Messages\Pages;

use App\Filament\Resources\Messages\MessageResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\DeleteAction;

class ViewMessage extends ViewRecord
{
    protected static string $resource = MessageResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (! $this->record->is_read) {
            $this->record->markAsRead();
        }

        return $data;
    }

    public function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}