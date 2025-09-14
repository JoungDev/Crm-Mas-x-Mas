<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\Resources\Customers\CustomerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
             ->label('Nuevo cliente')     // <--- texto del botón
                ->icon('heroicon-m-user-plus')
        ];
    }

     public function getTitle(): string
    {
        return 'Lista de clientes';
    }
    
    public function getHeading(): string
    {
        return 'Clientes';
    }
    
}
