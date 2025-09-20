<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('invoice_id')
                ->label('Factura (remisión)')
                ->relationship('invoice', 'remision')
                ->searchable()
                ->preload()
                ->default(fn () => request()->integer('invoice_id') ?: null)
                ->required(),

            DatePicker::make('date')
                ->label('Fecha')
                ->default(now())
                ->required(),

            TextInput::make('amount')
                ->label('Monto')
                ->numeric()
                ->minValue(0.01)
                ->step('0.01')
                ->required(),

            TextInput::make('method')
                ->label('Método'),

            Textarea::make('notes')
                ->label('Notas')
                ->rows(2)
                ->columnSpanFull(),
        ])->columns(2);
    }
}
