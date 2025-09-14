<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    public const STATUS_PENDIENTE = 'pendiente';
    public const STATUS_PARCIAL   = 'parcial';
    public const STATUS_PAGADA    = 'pagada';
    public const STATUS_ANULADA   = 'anulada';

    protected $guarded = [];

    protected $casts = [
        'date'  => 'date',
        'total' => 'decimal:2',
    ];

    protected $appends = ['paid_amount', 'balance'];

    /** Relaciones */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /** Recalcular total (suma de ítems) */
    public function recalcTotals(): void
    {
        $this->total = (float) $this->items()->sum('line_total');
        $this->save();
    }

    /** Recalcular estado según abonos */
    public function recalcStatus(): void
    {
        if ($this->status === self::STATUS_ANULADA) {
            return;
        }

        $paid = (float) $this->payments()->sum('amount');

        if ($paid <= 0) {
            $this->status = self::STATUS_PENDIENTE;
        } elseif ($paid < (float) $this->total) {
            $this->status = self::STATUS_PARCIAL;
        } else {
            $this->status = self::STATUS_PAGADA;
        }

        $this->save();
    }

    /** Atributos calculados */
    public function getPaidAmountAttribute(): float
    {
        return (float) $this->payments()->sum('amount');
    }

    public function getBalanceAttribute(): float
    {
        return max(0, (float) $this->total - $this->paid_amount);
    }
}
