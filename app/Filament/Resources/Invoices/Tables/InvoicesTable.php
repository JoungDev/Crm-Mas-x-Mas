<?php

namespace App\Filament\Resources\Invoices\Tables;

use App\Models\Invoice;
use App\Models\Payment;
use Filament\Actions\Action as ActionsAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;


class InvoicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('remision')
                    ->searchable(),
                // antes: TextColumn::make('customer_id')->numeric()->sortable(),
                TextColumn::make('customer.name')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('customer_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('date')
                    ->label('Fecha')
                    ->date()
                    ->sortable(),
                TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Estado')
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
                SelectFilter::make('customer_id')
                    ->label('Cliente')
                    ->relationship('customer', 'name')   // usa la relación
                    ->searchable()
                    ->preload()
                    ->default(fn() => request()->integer('customer_id')),

            ])
            ->recordActions([
                EditAction::make(),
                ActionsAction::make('agregarAbono')
                    ->label('Abono')
                    ->icon('heroicon-m-banknotes')
                    ->modalHeading('Agregar abono a la factura')
                    ->form([
                        DatePicker::make('date')
                            ->label('Fecha')
                            ->default(now())
                            ->required(),

                        TextInput::make('amount')
                            ->label('Valor del abono')
                            ->numeric()
                            ->minValue(0.01)
                            ->required(),

                        Select::make('method')
                            ->label('Método de pago')
                            ->options([
                                'efectivo'      => 'Efectivo',
                                'transferencia' => 'Transferencia',
                                'nequi'         => 'Nequi',
                                'daviplata'     => 'Daviplata',
                                'tarjeta_debito'  => 'Tarjeta débito',
                                'tarjeta_credito' => 'Tarjeta crédito',
                            ])
                            ->preload()
                            ->required(),

                        Textarea::make('notes')
                            ->label('Notas')
                            ->rows(2),
                    ])

                    ->action(function (Invoice $record, array $data) {
                        Payment::create([
                            'invoice_id' => $record->id,
                            'date'       => $data['date'],
                            'amount'     => $data['amount'],
                            'method'     => $data['method'],
                            'notes'      => $data['notes'] ?? null,
                        ]);

                        // Si manejas saldo/estado en la factura, actualízalo aquí:
                        // $record->refreshTotals(); // ejemplo
                        // $record->save();

                        Notification::make()
                            ->title('Abono registrado')
                            ->body('El abono fue agregado correctamente.')
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
