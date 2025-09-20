<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    /** Campos permitidos para asignación masiva */
    protected $fillable = [
        'invoice_id',   // FK a invoices.id
        'date',         // fecha del abono
        'amount',       // valor
        'method',       // método de pago (efectivo, transferencia, etc.)
        'notes',        // notas opcionales
    ];

    /** Casts */
    protected $casts = [
        'date'   => 'date',
        'amount' => 'decimal:2',
    ];

    /** Relaciones */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    /** Mantén el estado de la factura actualizado cuando se toquen abonos */
    protected static function booted(): void
    {
        static::created(fn (Payment $p) => $p->invoice?->recalcStatus());
        static::updated(fn (Payment $p) => $p->invoice?->recalcStatus());
        static::deleted(fn (Payment $p) => $p->invoice?->recalcStatus());
    }
}
