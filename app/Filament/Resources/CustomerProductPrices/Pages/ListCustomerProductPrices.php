<?php

namespace App\Filament\Resources\CustomerProductPrices\Pages;

use App\Filament\Resources\CustomerProductPrices\CustomerProductPriceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCustomerProductPrices extends ListRecords
{
    protected static string $resource = CustomerProductPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nuevo Precio Especial')     // <--- texto del botón
                ->icon('heroicon-m-plus')
        ];
    }
    public function getTitle(): string
    {
        return 'Precios Especiales';
    }
    public function getHeading(): string
    {
        return 'Precios Especiales';
    }
}
