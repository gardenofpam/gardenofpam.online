<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class ProjectForm
{
    public static function schema(): array
    {
        return [
            Section::make('Project Details')
                ->schema([
                    Select::make('niche')
                        ->options([
                            'cpemina'      => 'CPEmina',
                            'minapauldata' => 'MinaPaulData',
                        ])
                        ->required(),

                    Select::make('status')
                        ->options([
                            'published' => 'Published',
                            'draft'     => 'Draft',
                        ])
                        ->default('published')
                        ->required(),

                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Textarea::make('description')
                        ->required()
                        ->rows(3)
                        ->columnSpanFull(),

                    RichEditor::make('content')
                        ->columnSpanFull(),

                    FileUpload::make('thumbnail')
                        ->image()
                        ->directory('projects')
                        ->imageEditor()
                        ->columnSpanFull(),

                    TagsInput::make('technologies')
                        ->placeholder('Add technology e.g. Python, Arduino')
                        ->columnSpanFull(),

                    TextInput::make('github_url')
                        ->url()
                        ->prefix('https://'),

                    TextInput::make('live_url')
                        ->url()
                        ->prefix('https://'),

                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),
                ])->columns(2),
        ];
    }
}