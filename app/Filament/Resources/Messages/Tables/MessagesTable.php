<?php

namespace App\Filament\Resources\Messages\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MessagesTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sender_name')
                    ->label('Sender')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('sender_email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('from_niche')
                    ->label('From')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'gardenofpam'  => 'success',
                        'cpemina'      => 'info',
                        'minapauldata' => 'warning',
                        default        => 'gray',
                    }),

                TextColumn::make('subject')
                    ->label('Subject')
                    ->searchable()
                    ->limit(40),

                IconColumn::make('is_read')
                    ->label('Read')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                IconColumn::make('email_verified')
                    ->label('Verified')
                    ->boolean()
                    ->trueIcon('heroicon-o-shield-check')
                    ->falseIcon('heroicon-o-shield-exclamation')
                    ->trueColor('success')
                    ->falseColor('warning'),

                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                ViewAction::make()
                    ->after(function ($record): void {
                        if (! $record->is_read) {
                            $record->markAsRead();
                        }
                    }),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}

