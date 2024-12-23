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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_venta');
            $table->string('nombre_vendedor')->nullable();
            $table->string('nombre_cliente')->nullable();
            $table->integer('rut_cliente')->nullable();
            $table->integer('numero_cliente')->nullable();
            $table->string('email_cliente')->nullable();
            $table->integer('subtotal');

            $table->unsignedBigInteger('tipo_pago_id');
            $table->integer('descuento')->nullable();
            $table->string('nota')->nullable();
            $table->integer('monto_pagado')->nullable();
            $table->integer('estado_pago')->nullable();
            $table->integer('total');
            $table->timestamps();

    

        

            $table->foreign('tipo_pago_id')->references('id')->on('tipo_pago')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
