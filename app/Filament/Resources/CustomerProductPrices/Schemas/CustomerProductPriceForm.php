<?php

namespace App\Filament\Resources\CustomerProductPrices\Schemas;

use App\Models\Customer;
use App\Models\Product;
use Filament\Forms;
use Filament\Schemas\Schema;

final class CustomerProductPriceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            // CLIENTE
            Forms\Components\Select::make('customer_id')
                ->label('Cliente')
                ->relationship(name: 'customer', titleAttribute: 'name') // <- fuente de opciones
                ->searchable(['name', 'document']) // busca por nombre y documento
                ->preload()
                ->required()
                ->getOptionLabelFromRecordUsing(
                    fn(\App\Models\Customer $record) =>
                    trim($record->name . ($record->document ? ' — ' . $record->document : ''))
                ),

            // PRODUCTO
            Forms\Components\Select::make('product_id')
                ->label('Producto')
                ->relationship('product', 'name')   // <- fuente de opciones
                ->searchable(['name'])              // (quitaste sku, así que solo nombre)
                ->preload()
                ->required(),

            // PRECIO ESPECIAL
            Forms\Components\TextInput::make('special_price')
                ->label('Precio especial')
                ->numeric()
                ->minValue(0)
                ->step('0.01')
                ->required(),
        ])->columns(2);
    }
}
