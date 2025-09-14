<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    /** Relaciones */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function specialPrices(): HasMany
    {
        return $this->hasMany(CustomerProductPrice::class);
    }
}
