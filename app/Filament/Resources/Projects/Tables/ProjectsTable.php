<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail'),
                TextColumn::make('niche')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'gardenofpam'  => 'success',
                        'cpemina'      => 'info',
                        'minapauldata' => 'warning',
                        default        => 'gray',
                    }),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('slug')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published'   => 'success',
                        'coming_soon' => 'warning',
                        'draft'       => 'gray',
                        default       => 'gray',
                    }),
                TextColumn::make('sort_order')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                SelectFilter::make('niche')
                    ->options([
                        'gardenofpam'  => 'GardenOfPam',
                        'cpemina'      => 'CPEmina',
                        'minapauldata' => 'MinaPaulData',
                    ]),
                SelectFilter::make('status')
                    ->options([
                        'published'   => 'Published',
                        'coming_soon' => 'Coming Soon',
                        'draft'       => 'Draft',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
