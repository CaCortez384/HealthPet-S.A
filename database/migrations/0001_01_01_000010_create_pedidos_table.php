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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained(); // id del usuario que realizó el pedido (si esta registrado)
            $table->string('nombre_cliente'); // nombre del cliente (si no esta registrado)
            $table->string('email_cliente'); // email del cliente (si no esta registrado)
            $table->string('telefono_cliente'); // telefono del cliente (si no esta registrado)
            $table->integer('estado_pedido'); // 0: pendiente, 1: para entrea, 2: entregado
            $table->integer('total'); // total del pedido
            $table->integer('monto_pagado')->nullable();  // monto pagado por el cliente
            $table->integer('estado_pago')->nullable(); // 0: pendiente, 1: pagado,            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
