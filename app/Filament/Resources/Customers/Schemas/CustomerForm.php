<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                TextInput::make('document')
                    ->label('Documento')
                    ->default(null),
                TextInput::make('phone')
                    ->label('Teléfono')
                    ->tel()
                    ->default(null),
                TextInput::make('email')
                    ->label('Correo')
                    ->email()
                    ->default(null),
                TextInput::make('address')
                    ->label('Dirección')
                    ->default(null),
                TextInput::make('status')
                    ->label('Estado')
                    ->required()
                    ->default('activo'),
                TextInput::make('city')
                    ->label('Ciudad')
                    ->default(null),
            ]);
    }
}
