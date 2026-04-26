<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function schema(): array
    {
        return [
            Section::make('Project Details')
                ->schema([
                    Select::make('niche')
                        ->options([
                            'gardenofpam'  => 'GardenOfPam',
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
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug((string) $state)))
                        ->helperText('The project page URL is auto-generated from this title.')
                        ->columnSpanFull(),

                    TextInput::make('slug')
                        ->label('Slug')
                        ->disabled()
                        ->dehydrated(false)
                        ->placeholder('Auto-generated from the title')
                        ->columnSpanFull(),

                    Textarea::make('description')
                        ->required()
                        ->rows(3)
                        ->helperText('Shown in the showcase card as the short project summary.')
                        ->columnSpanFull(),

                    RichEditor::make('content')
                        ->label('Project Details')
                        ->columnSpanFull(),

                    FileUpload::make('thumbnail')
                        ->image()
                        ->directory('projects')
                        ->imageEditor()
                        ->maxSize(2048)
                        ->imageEditorAspectRatios(['16:9', '4:3', '1:1'])
                        ->columnSpanFull(),

                    FileUpload::make('project_images')
                        ->label('Project Gallery Images')
                        ->image()
                        ->multiple()
                        ->reorderable()
                        ->directory('projects/gallery')
                        ->imageEditor()
                        ->maxSize(2048)
                        ->columnSpanFull(),

                    FileUpload::make('wiring_images')
                        ->label('Wiring / Connection Images')
                        ->image()
                        ->multiple()
                        ->reorderable()
                        ->directory('projects/wiring')
                        ->imageEditor()
                        ->maxSize(2048)
                        ->columnSpanFull(),

                    TagsInput::make('technologies')
                        ->placeholder('Add technology e.g. Python, Arduino')
                        ->columnSpanFull(),

                    Repeater::make('components')
                        ->label('Components Used')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->placeholder('ESP32 Development Board'),
                            TextInput::make('shopee_url')
                                ->label('Shopee Affiliate Link')
                                ->url()
                                ->placeholder('https://shopee.ph/...'),
                            TextInput::make('tiktok_url')
                                ->label('TikTok Shop Link')
                                ->url()
                                ->placeholder('https://www.tiktok.com/...'),
                        ])
                        ->reorderable()
                        ->columns(1)
                        ->columnSpanFull(),

                    Select::make('code_language')
                        ->options([
                            'cpp' => 'C++ / Arduino',
                            'python' => 'Python',
                            'php' => 'PHP',
                            'javascript' => 'JavaScript',
                            'html' => 'HTML',
                            'css' => 'CSS',
                            'json' => 'JSON',
                            'sql' => 'SQL',
                            'yaml' => 'YAML',
                            'xml' => 'XML',
                        ])
                        ->default('cpp'),

                    Textarea::make('source_code')
                        ->label('Source Code')
                        ->rows(18)
                        ->placeholder('// Paste the main project source code here')
                        ->columnSpanFull(),

                    TextInput::make('github_url')
                        ->url()
                        ->prefix('https://'),

                    TextInput::make('live_url')
                        ->url()
                        ->prefix('https://'),

                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0)
                        ->helperText('Lower numbers appear first in the frontend showcase.'),
                ])->columns(2),
        ];
    }

    public static function schemaForNiche(string $niche): array
    {
        return [
            Section::make('Project Details')
                ->schema([
                    Hidden::make('niche')
                        ->default($niche)
                        ->dehydrated(true),

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
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug((string) $state)))
                        ->helperText('The project page URL is auto-generated from this title.')
                        ->columnSpanFull(),

                    TextInput::make('slug')
                        ->label('Slug')
                        ->disabled()
                        ->dehydrated(false)
                        ->placeholder('Auto-generated from the title')
                        ->columnSpanFull(),

                    Textarea::make('description')
                        ->required()
                        ->rows(3)
                        ->helperText('Shown in the showcase card as the short project summary.')
                        ->columnSpanFull(),

                    RichEditor::make('content')
                        ->label('Project Details')
                        ->columnSpanFull(),

                    FileUpload::make('thumbnail')
                        ->image()
                        ->directory('projects')
                        ->imageEditor()
                        ->maxSize(2048)
                        ->imageEditorAspectRatios(['16:9', '4:3', '1:1'])
                        ->columnSpanFull(),

                    FileUpload::make('project_images')
                        ->label('Project Gallery Images')
                        ->image()
                        ->multiple()
                        ->reorderable()
                        ->directory('projects/gallery')
                        ->imageEditor()
                        ->maxSize(2048)
                        ->columnSpanFull(),

                    FileUpload::make('wiring_images')
                        ->label('Wiring / Connection Images')
                        ->image()
                        ->multiple()
                        ->reorderable()
                        ->directory('projects/wiring')
                        ->imageEditor()
                        ->maxSize(2048)
                        ->columnSpanFull(),

                    TagsInput::make('technologies')
                        ->placeholder('Add technology e.g. Python, Arduino')
                        ->columnSpanFull(),

                    Repeater::make('components')
                        ->label('Components Used')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->placeholder('ESP32 Development Board'),
                            TextInput::make('shopee_url')
                                ->label('Shopee Affiliate Link')
                                ->url()
                                ->placeholder('https://shopee.ph/...'),
                            TextInput::make('tiktok_url')
                                ->label('TikTok Shop Link')
                                ->url()
                                ->placeholder('https://www.tiktok.com/...'),
                        ])
                        ->reorderable()
                        ->columns(1)
                        ->columnSpanFull(),

                    Select::make('code_language')
                        ->options([
                            'cpp' => 'C++ / Arduino',
                            'python' => 'Python',
                            'php' => 'PHP',
                            'javascript' => 'JavaScript',
                            'html' => 'HTML',
                            'css' => 'CSS',
                            'json' => 'JSON',
                            'sql' => 'SQL',
                            'yaml' => 'YAML',
                            'xml' => 'XML',
                        ])
                        ->default('cpp'),

                    Textarea::make('source_code')
                        ->label('Source Code')
                        ->rows(18)
                        ->placeholder('// Paste the main project source code here')
                        ->columnSpanFull(),

                    TextInput::make('github_url')
                        ->url()
                        ->prefix('https://'),

                    TextInput::make('live_url')
                        ->url()
                        ->prefix('https://'),

                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0)
                        ->helperText('Lower numbers appear first in the frontend showcase.'),
                ])->columns(2),
        ];
    }
}