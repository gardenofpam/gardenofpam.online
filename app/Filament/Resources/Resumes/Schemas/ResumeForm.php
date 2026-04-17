<?php

namespace App\Filament\Resources\Resumes\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;

class ResumeForm
{
    public static function schema(): array
    {
        return [
            Section::make('Resume Version')
                ->schema([
                    TextInput::make('version')
                        ->required()
                        ->default('1.0'),
                    Toggle::make('is_active')
                        ->label('Set as Active Resume')
                        ->default(true),
                ])->columns(2),

            Section::make('Personal Information')
                ->schema([
                    KeyValue::make('personal_info')
                        ->keyLabel('Field')
                        ->valueLabel('Value')
                        ->default([
                            'name'     => 'Paul Albert Mina',
                            'email'    => '',
                            'phone'    => '',
                            'location' => '',
                            'summary'  => '',
                            'linkedin' => '',
                            'github'   => '',
                        ])
                        ->columnSpanFull(),
                ]),

            Section::make('Education')
                ->schema([
                    Repeater::make('education')
                        ->schema([
                            TextInput::make('school')->required(),
                            TextInput::make('degree')->required(),
                            TextInput::make('field'),
                            TextInput::make('start_year'),
                            TextInput::make('end_year'),
                        ])
                        ->columns(2)
                        ->columnSpanFull(),
                ])
                ->collapsible(),

            Section::make('Work Experience')
                ->schema([
                    Repeater::make('experience')
                        ->schema([
                            TextInput::make('company')->required(),
                            TextInput::make('position')->required(),
                            TextInput::make('start_date'),
                            TextInput::make('end_date'),
                            TextInput::make('description'),
                        ])
                        ->columns(2)
                        ->columnSpanFull(),
                ])
                ->collapsible(),

            Section::make('Skills')
                ->schema([
                    TagsInput::make('skills')
                        ->placeholder('Add skill')
                        ->columnSpanFull(),
                ])
                ->collapsible(),

            Section::make('Tools')
                ->schema([
                    TagsInput::make('tools')
                        ->placeholder('Add tool e.g. Python, Tableau, SQL')
                        ->columnSpanFull(),
                ])
                ->collapsible(),
        ];
    }
}