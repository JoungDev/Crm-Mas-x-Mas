<?php

namespace App\Filament\Resources\CustomerProductPrices\Pages;

use App\Filament\Resources\CustomerProductPrices\CustomerProductPriceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCustomerProductPrice extends EditRecord
{
    protected static string $resource = CustomerProductPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return 'Editar Precio Especial';
    }

    public function getHeading(): string
    {
        return 'Editar precio especial';
    }
}
