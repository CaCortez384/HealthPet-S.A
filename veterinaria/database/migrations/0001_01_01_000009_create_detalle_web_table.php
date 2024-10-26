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
        Schema::create('detalle_web', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_producto')->constrained('producto'); // Relación con la tabla producto
            $table->string('marca')->nullable(); // Marca del producto
            $table->string('descripcion')->nullable(); // Descripción del producto
            $table->string('imagen')->nullable(); // Imagen del producto
            $table->decimal('contenido_neto', 8, 2)->nullable(); // Contenido neto del producto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_web');
    }
};
