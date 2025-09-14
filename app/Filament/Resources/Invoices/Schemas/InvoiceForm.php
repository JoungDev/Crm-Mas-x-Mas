<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('remision')
                    ->required(),
                TextInput::make('customer_id')
                    ->required()
                    ->numeric(),
                DatePicker::make('date')
                    ->label('Fecha')
                    ->required(),
                TextInput::make('total')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('status')
                    ->label('Estado')
                    ->required()
                    ->default('pendiente'),
            ]);
    }
}
