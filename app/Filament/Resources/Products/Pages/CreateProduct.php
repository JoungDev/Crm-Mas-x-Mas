<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    public function getTitle(): string
    {
        return 'Crear Producto';
    }
    public function getHeading(): string
    {
        return 'Crear Producto';
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
