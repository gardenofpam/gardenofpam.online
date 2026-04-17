<?php

namespace App\Filament\Resources\Messages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class MessageForm
{
    public static function schema(): array
    {
        return [
            TextInput::make('sender_name')
                ->label('Name')
                ->disabled()
                ->dehydrated(false),

            TextInput::make('sender_email')
                ->label('Email')
                ->disabled()
                ->dehydrated(false),

            TextInput::make('from_niche')
                ->label('From Niche')
                ->disabled()
                ->dehydrated(false),

            TextInput::make('subject')
                ->label('Subject')
                ->disabled()
                ->dehydrated(false),

            Textarea::make('body')
                ->label('Message')
                ->disabled()
                ->dehydrated(false)
                ->rows(8),

            TextInput::make('email_verified')
                ->label('Email Verified')
                ->disabled()
                ->dehydrated(false),

            TextInput::make('is_read')
                ->label('Read Status')
                ->disabled()
                ->dehydrated(false),

            TextInput::make('created_at')
                ->label('Received At')
                ->disabled()
                ->dehydrated(false),
        ];
    }
}

