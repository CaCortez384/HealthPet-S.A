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
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('id_producto');
            $table->integer('cantidad'); // cantidad del pedido
            $table->integer('precio'); // precio del pedido 
            $table->integer('subtotal'); // subtotal del pedido 
            $table->integer('descuento')->nullable(); // descuento del pedido (si aplica)
            $table->unsignedBigInteger('tipo_pago_id');
            $table->string('nota')->nullable(); // nota del pedito
            $table->timestamps();

            // Agrega la relación si es necesario
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->foreign('tipo_pago_id')->references('id')->on('tipo_pago');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedidos');
    }
};
