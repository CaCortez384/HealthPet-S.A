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
        Schema::create('producto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('codigo')-> unique();
            $table->integer('precio_de_compra');
            $table->integer('precio_de_venta');
            $table->string('unidades');
            $table->integer('stock');
            $table->integer('id_presentacion')->nullable();
            $table->integer('id_categoria')->nullable();
            $table->timestamp('fecha_de_vencimiento');
            $table->integer('cantidad_minima_requerida')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
