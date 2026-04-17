<?php

namespace App\Filament\Resources\Certificates\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class CertificateForm
{
    public static function schema(): array
    {
        return [
            Section::make('Certificate Details')
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    TextInput::make('issuer')
                        ->required()
                        ->maxLength(255),

                    Select::make('status')
                        ->options([
                            'published' => 'Published',
                            'draft'     => 'Draft',
                        ])
                        ->default('published')
                        ->required(),

                    DatePicker::make('issued_date')
                        ->required(),

                    DatePicker::make('expiry_date'),

                    TextInput::make('credential_url')
                        ->url()
                        ->prefix('https://')
                        ->columnSpanFull(),

                    FileUpload::make('image')
                        ->image()
                        ->directory('certificates')
                        ->imageEditor()
                        ->columnSpanFull(),

                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),
                ])->columns(2),
        ];
    }
}