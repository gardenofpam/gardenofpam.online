<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class ProfileForm
{
    public static function schema(): array
    {
        return [
            ...self::basicSections(),
            self::gardenSection()->collapsible()->collapsed(),
            self::engineeringSection()->collapsible()->collapsed(),
            self::dataSection()->collapsible()->collapsed(),
        ];
    }

    public static function schemaForNiche(string $niche): array
    {
        $sections = [
            ...self::basicSections($niche),
        ];

        if ($niche === 'gardenofpam') {
            $sections[] = self::gardenSection();
        }

        if ($niche === 'cpemina') {
            $sections[] = self::engineeringSection();
        }

        if ($niche === 'minapauldata') {
            $sections[] = self::dataSection();
        }

        return $sections;
    }

    protected static function basicSections(?string $lockedNiche = null): array
    {
        return [
            Section::make('Basic Info')
                ->schema([
                    $lockedNiche
                        ? Hidden::make('niche')->default($lockedNiche)->dehydrated(true)
                        : Select::make('niche')
                            ->options([
                                'gardenofpam'  => 'Garden of Pam',
                                'cpemina'      => 'CPEmina',
                                'minapauldata' => 'MinaPaulData',
                            ])
                            ->required()
                            ->unique(ignoreRecord: true),

                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('tagline')
                        ->maxLength(255)
                        ->columnSpanFull(),

                    RichEditor::make('bio')
                        ->columnSpanFull(),

                    FileUpload::make('photo')
                        ->image()
                        ->disk('public')
                        ->visibility('public')
                        ->directory('profiles')
                        ->getUploadedFileUsing(static function (BaseFileUpload $component, string $file, string | array | null $storedFileNames): ?array {
                            $storage = $component->getDisk();

                            if (! $storage->exists($file)) {
                                return null;
                            }

                            return [
                                'name' => basename($file),
                                'size' => $storage->size($file),
                                'type' => $storage->mimeType($file),
                                'url' => asset('storage/' . ltrim($file, '/')),
                            ];
                        })
                        ->imageEditor()
                        ->columnSpanFull(),
                ])->columns(2),

            Section::make('Social Links')
                ->schema([
                    KeyValue::make('social_links')
                        ->keyLabel('Platform')
                        ->valueLabel('URL')
                        ->columnSpanFull(),
                ])->collapsible(),
        ];
    }

    protected static function gardenSection(): Section
    {
        return Section::make('GardenofPam - Personal Info')
            ->schema([
                TagsInput::make('interests')
                    ->placeholder('Add interest e.g. Reading, Cooking')
                    ->columnSpanFull(),

                Repeater::make('favorite_movies')
                    ->label('Favorite Movies')
                    ->schema([
                        TextInput::make('title')->required(),
                        TextInput::make('genre'),
                        TextInput::make('year'),
                        Textarea::make('reason')->rows(2),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->collapsible(),

                Repeater::make('favorite_series')
                    ->label('Favorite Series')
                    ->schema([
                        TextInput::make('title')->required(),
                        TextInput::make('genre'),
                        TextInput::make('seasons'),
                        Textarea::make('reason')->rows(2),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->collapsible(),
            ]);
    }

    protected static function engineeringSection(): Section
    {
        return Section::make('CPEmina - Engineering Skills')
            ->schema([
                FileUpload::make('phone_video')
                    ->label('Phone Video')
                    ->disk('public')
                    ->visibility('public')
                    ->directory('profiles/videos')
                    ->acceptedFileTypes(['video/mp4', 'video/quicktime', 'video/webm'])
                    ->getUploadedFileUsing(static function (BaseFileUpload $component, string $file, string | array | null $storedFileNames): ?array {
                        $storage = $component->getDisk();

                        if (! $storage->exists($file)) {
                            return null;
                        }

                        return [
                            'name' => basename($file),
                            'size' => $storage->size($file),
                            'type' => $storage->mimeType($file),
                            'url' => asset('storage/' . ltrim($file, '/')),
                        ];
                    })
                    ->downloadable()
                    ->openable()
                    ->columnSpanFull(),
                Repeater::make('engineering_skills')
                    ->label('Engineering Skills')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->placeholder('e.g. Circuit Design'),
                        Select::make('level')
                            ->options([
                                'Beginner'     => 'Beginner',
                                'Intermediate' => 'Intermediate',
                                'Advanced'     => 'Advanced',
                            ]),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    protected static function dataSection(): Section
    {
        return Section::make('MinaPaulData - Data Skills')
            ->schema([
                Repeater::make('data_skills')
                    ->label('Data Skills')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->placeholder('e.g. Python, SQL, Tableau'),
                        Select::make('level')
                            ->options([
                                'Beginner'     => 'Beginner',
                                'Intermediate' => 'Intermediate',
                                'Advanced'     => 'Advanced',
                            ]),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
