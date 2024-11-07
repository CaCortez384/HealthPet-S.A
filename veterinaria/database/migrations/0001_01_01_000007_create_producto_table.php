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
            $table->string('nombre'); // Nombre del producto
            $table->string('imagen')->nullable(); // Imagen del producto
            $table->string('descripcion')->nullable(); // Descripción del producto
            $table->integer('codigo')->unique(); // Código de barras
            $table->integer('precio_de_compra');    // Precio de compra para productos en unidades
            $table->integer('precio_de_venta'); // Precio de venta para productos en unidades
            $table->integer('precio_fraccionado')->nullable(); // Precio de venta para productos
            $table->foreignId('id_especie')->nullable()->constrained('especie'); // Relación con la tabla especie
            $table->foreignId('id_unidad')->nullable()->constrained('unidad'); 
            $table->foreignId('id_presentacion')->nullable()->constrained('presentacion');  // dependiendo del tipo de producto, puede ser inyectable, comprimido, seco, humedo, jueguete, etc
            $table->foreignId('id_categoria')->nullable()->constrained('categoria'); // Relación con la tabla categoria 
            
            // Campos de stock general
            $table->integer('stock_unidades')->nullable();  // Stock general para todos los productos en unidades.
            
            //  Inyectables
            $table->integer('stock_total_ml')->nullable();  // Stock total en ml para inyectables se calcula con stock_total_ml x stock_unidades
            $table->integer('ml_por_unidad')->nullable();   // Cantidad de ml por unidad de inyectable 
            
            //  Comprimidos
            $table->integer('stock_total_comprimidos')->nullable();  // Stock total de comprimidos se calcula con stock_total_comprimidos x stock_unidades
            $table->integer('comprimidos_por_caja')->nullable();     // Cantidad de comprimidos por caja
            
            // Venta granular y a granel
            $table->boolean('vende_a_granel')->default(false);  // Indica si el producto se puede vender a granel
            $table->integer('unidades_por_envase')->nullable(); // Cantidad de unidades por envase (para productos como churu)
            $table->integer('unidades_granel_total')->nullable();     // Cantidad de unidades en stock para productos a granel se calcula con unidades_granel_total x stock_unidades
            
            // Manejo de stock
            $table->boolean('mostrar_web')->default(false);  // Indica si el producto se muestra en la web
            $table->timestamp('fecha_de_vencimiento')->nullable(); // Fecha de vencimiento del producto
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
