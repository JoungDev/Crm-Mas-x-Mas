<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                TextInput::make('base_price')
                    ->label('Precio Base')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('status')
                    ->label('Estado')
                    ->required()
                    ->default('activo'),
            ]);
    }
}
