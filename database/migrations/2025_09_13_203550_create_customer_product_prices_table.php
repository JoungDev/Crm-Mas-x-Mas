<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_product_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->decimal('special_price', 12, 2);
            $table->timestamps();

            // Un override por cliente+producto
            $table->unique(['customer_id', 'product_id'], 'customer_product_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_product_prices');
    }
};
