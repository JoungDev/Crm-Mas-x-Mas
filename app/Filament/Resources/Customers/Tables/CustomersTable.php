<?php

namespace App\Filament\Resources\Customers\Tables;

use App\Filament\Resources\Invoices\InvoiceResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Resources\Invoices\InvoicesResource;
use App\Models\Customer;
use Filament\Actions\Action as ActionsAction;

class CustomersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                TextColumn::make('document')
                    ->label('Documento')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Teléfono')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Correo')
                    ->searchable(),
                TextColumn::make('address')
                    ->label('Dirección')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->searchable(),
                TextColumn::make('city')
                    ->label('Ciudad')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),

                ActionsAction::make('ver_facturas')
                    ->label('Ver facturas')
                    ->icon('heroicon-m-document-text')
                    ->slideOver() // opcional (quítalo si prefieres modal centrado)
                    ->modalWidth('7xl')
                    ->modalHeading(fn(Customer $r) => 'Facturas de ' . $r->name)
                    ->modalSubmitAction(false)
                    ->modalContent(function (Customer $record) {
                        $invoices = $record->invoices()
                            ->withSum('payments', 'amount') // payments_sum_amount
                            ->orderByDesc('date')
                            ->get();

                        $totalFacturas = (float) $invoices->sum('total');
                        $totalAbonos   = (float) $invoices->sum('payments_sum_amount');
                        $totalSaldo    = max(0, $totalFacturas - $totalAbonos);

                        return view('cartera-modal', [
                            'customer'      => $record,
                            'invoices'      => $invoices,
                            'totalFacturas' => $totalFacturas,
                            'totalAbonos'   => $totalAbonos,
                            'totalSaldo'    => $totalSaldo,
                        ]);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
