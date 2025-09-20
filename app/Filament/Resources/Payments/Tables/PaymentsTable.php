<?php

namespace App\Filament\Resources\Payments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice.remision')
                    ->label('Remisión')
                    ->searchable(),
                TextColumn::make('invoice.customer.name')
                    ->label('Cliente')
                    ->searchable(),
                TextColumn::make('date')
                    ->label('Fecha')
                    ->date(),
                TextColumn::make('amount')
                    ->label('Monto')
                    ->money('COP'),
                TextColumn::make('method')
                    ->label('Método'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
