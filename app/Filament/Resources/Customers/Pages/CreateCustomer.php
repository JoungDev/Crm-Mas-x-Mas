<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\Resources\Customers\CustomerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

     public function getTitle(): string
    {
        return 'Crear Cliente';
    }

    public function getHeading(): string
    {
        return 'Crear cliente';
    }
     protected function getFormActions(): array
    {
        return [
            // Botón principal: Crear
            $this->getCreateFormAction()
                ->label('Crear'),

            // Botón Cancelar
            $this->getCancelFormAction()
                ->label('Cancelar'),
        ];
    }
}
