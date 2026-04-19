<?php

namespace App\Filament\Resources\Resumes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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
                    FileUpload::make('resume_file')
                        ->label('Downloadable Resume File')
                        ->disk('public')
                        ->directory('resumes')
                        ->acceptedFileTypes(['application/pdf'])
                        ->downloadable()
                        ->openable()
                        ->preserveFilenames(),
                    Toggle::make('is_active')
                        ->label('Set as Active Resume')
                        ->default(true),
                ])->columns(3),

            Section::make('Contact Information')
                ->schema([
                    TextInput::make('personal_info.name')
                        ->label('Full Name')
                        ->default('Paul Albert Mina')
                        ->required(),
                    TextInput::make('personal_info.email')
                        ->email()
                        ->default('minapaul.data@gmail.com'),
                    TextInput::make('personal_info.phone')
                        ->default('09928490948'),
                    TextInput::make('personal_info.location')
                        ->default('Naga City'),
                    TextInput::make('personal_info.linkedin')
                        ->label('LinkedIn URL')
                        ->url(),
                    TextInput::make('personal_info.github')
                        ->label('GitHub URL')
                        ->url(),
                ])
                ->columns(2),

            Section::make('Professional Summary')
                ->schema([
                    Textarea::make('professional_summary')
                        ->rows(5)
                        ->required()
                        ->helperText('Keep this to 3 to 5 concise sentences focused on certifications, hands-on experience, strengths, and your target role.')
                        ->columnSpanFull(),
                ]),

            Section::make('Certifications')
                ->schema([
                    Repeater::make('certifications')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->placeholder('Google IT Support Professional Certificate'),
                            TextInput::make('issuer')
                                ->placeholder('Google'),
                            TextInput::make('date')
                                ->placeholder('Apr 2026'),
                        ])
                        ->columns(3)
                        ->columnSpanFull(),
                ])
                ->collapsible(),

            Section::make('Technical Skills')
                ->schema([
                    TagsInput::make('technical_skills.help_desk_support')
                        ->label('Help Desk & Support')
                        ->placeholder('Add support skill'),
                    TagsInput::make('technical_skills.infrastructure')
                        ->label('Infrastructure')
                        ->placeholder('Add infrastructure skill'),
                    TagsInput::make('technical_skills.os_tools')
                        ->label('OS & Tools')
                        ->placeholder('Add tool or OS'),
                ])
                ->columns(1)
                ->collapsible(),

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
                            TextInput::make('position')->required(),
                            TextInput::make('company')
                                ->label('Company / Project')
                                ->required(),
                            TextInput::make('start_date'),
                            TextInput::make('end_date'),
                            Repeater::make('bullets')
                                ->schema([
                                    TextInput::make('text')
                                        ->label('Bullet')
                                        ->required(),
                                ])
                                ->helperText('Use short bullet points with strong action verbs.')
                                ->columnSpanFull(),
                        ])
                        ->columns(2)
                        ->columnSpanFull(),
                ])
                ->collapsible(),
        ];
    }
}
