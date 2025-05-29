<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class inventarioTest extends TestCase
{



    public function test_crear()
    {
        $crearProducto = $this->get(route('inventario.crear'));
        $crearProducto->assertStatus(200)->assertViewIs('inventario.crear');
        $crearProducto = $this->post(route('inventario.store'), [
            'nombre' => 'Producto de prueba3',
            'codigo' => '1234567',
            'precio_de_compra' => 100,
            'precio_de_venta' => 150,
            'unidad' => 1,
            'presentacion' => 1,
            'categoria' => 1,
            'stock_unidades' => 10,
            'fecha_de_vencimiento' => '2022-12-31',
            'cantidad_minima_requerida' => 5
        ]);
        $crearProducto->assertStatus(302)->assertRedirect(route('listar.productos'));
    }

    public function test_detalle()
    {
        $detalleProducto = $this->get(route('detalle2.producto', ['id' => 41]));
        $detalleProducto->assertStatus(200)->assertViewIs('inventario.detalle2');
    }

    public function test_editar()
    {
        $editarProducto = $this->get(route('editar.producto', ['producto' => 41]));
        $editarProducto->assertStatus(200)->assertViewIs('inventario.editar');
        $editarProducto = $this->put(route('actualizar.producto', ['producto' => 41]), [
            'nombre' => 'Producto de prueba3',
            'codigo' => '1234567',
            'precio_de_compra' => 150,
            'precio_de_venta' => 300,
            'unidad' => 1,
            'presentacion' => 1,
            'categoria' => 1,
            'stock_unidades' => 20,
            'fecha_de_vencimiento' => '2022-12-31',
            'cantidad_minima_requerida' => 5
        ]);
        $editarProducto->assertStatus(302)->assertRedirect(route('listar.productos'));
    }

    public function test_eliminar()
    {
        $eliminarProductos = $this->delete(route('eliminar.producto', ['producto' => 41]));
        $eliminarProductos->assertStatus(302)->assertRedirect(route('listar.productos'));
    }

    public function test_listar()
    {
        $listarProductos = $this->get(route('listar.productos'));
        $listarProductos->assertStatus(200)->assertViewIs('inventario.listar');
    }
}
