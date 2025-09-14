<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id(); // interno
            $table->string('remision', 50)->unique(); // identificador de negocio
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnUpdate()->restrictOnDelete();
            $table->date('date')->index();
            $table->decimal('total', 12, 2)->default(0)->index();
            $table->string('status', 20)->default('pendiente'); // pendiente/parcial/pagada/anulada
            $table->timestamps();

            $table->index(['customer_id', 'date']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
