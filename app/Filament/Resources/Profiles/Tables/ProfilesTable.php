<?php

namespace App\Filament\Resources\Profiles\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProfilesTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->circular(),
                TextColumn::make('niche')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'gardenofpam'  => 'success',
                        'cpemina'      => 'info',
                        'minapauldata' => 'warning',
                        default        => 'gray',
                    }),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('tagline')
                    ->limit(40),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}

