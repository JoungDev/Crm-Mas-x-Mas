<?php

namespace App\Filament\Resources\Invoices\Pages;

use App\Filament\Resources\Invoices\InvoiceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;
     public function getTitle(): string
    {
        return 'Crear Factura';
    }

    public function getHeading(): string
    {
        return 'Crear Factura';
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
