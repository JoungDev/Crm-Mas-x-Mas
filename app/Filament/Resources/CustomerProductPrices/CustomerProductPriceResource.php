<?php

namespace App\Filament\Resources\CustomerProductPrices;

use App\Filament\Resources\CustomerProductPrices\Pages\CreateCustomerProductPrice;
use App\Filament\Resources\CustomerProductPrices\Pages\EditCustomerProductPrice;
use App\Filament\Resources\CustomerProductPrices\Pages\ListCustomerProductPrices;
use App\Filament\Resources\CustomerProductPrices\Schemas\CustomerProductPriceForm;
use App\Filament\Resources\CustomerProductPrices\Tables\CustomerProductPricesTable;
use App\Models\CustomerProductPrice;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables;

class CustomerProductPriceResource extends Resource
{
    protected static ?string $navigationLabel = 'Precios Especiales';

    protected static ?string $model = CustomerProductPrice::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $recordTitleAttribute = 'model';

    public static function form(Schema $schema): Schema
    {
        return CustomerProductPriceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CustomerProductPricesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCustomerProductPrices::route('/'),
            'create' => CreateCustomerProductPrice::route('/create'),
            'edit' => EditCustomerProductPrice::route('/{record}/edit'),
        ];
    }
    
}
