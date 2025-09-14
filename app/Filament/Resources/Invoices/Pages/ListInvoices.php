<?php

namespace App\Filament\Resources\Invoices\Pages;

use App\Filament\Resources\Invoices\InvoiceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInvoices extends ListRecords
{
    protected static string $resource = InvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
             ->label('Nueva factura')     // <--- texto del botón
                ->icon('heroicon-m-document-plus')
        ];
    }
    public function getHeading(): string
    {
        return 'Facturas';
    }
}
