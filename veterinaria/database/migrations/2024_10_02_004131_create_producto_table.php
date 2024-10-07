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
            $table->integer('codigo')->unique();
            $table->integer('precio_de_compra');
            $table->integer('precio_de_venta');
            $table->string('id_unidad');
            $table->integer('id_presentacion')->nullable();  // 1 = Comprimidos, 2 = Inyectables, 3 = Otros (unidades sueltas o envases)
            $table->integer('id_categoria')->nullable();
            
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
            $table->timestamp('fecha_de_vencimiento')->nullable();
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
