<?php

namespace App\Filament\Resources\CustomerProductPrices\Pages;

use App\Filament\Resources\CustomerProductPrices\CustomerProductPriceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerProductPrice extends CreateRecord
{
    protected static string $resource = CustomerProductPriceResource::class;

    public function getTitle(): string
    {
        return 'Crear Precio Especial';
    }
    
    public function getHeading(): string
    {
        return 'Crear precio especial ';
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
