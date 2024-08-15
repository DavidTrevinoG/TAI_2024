<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = [
        'nombre',
        'id_categorias',
        'precio_venta',
        'precio_compra',
        'fecha_compra',
        'color',
        'descripcion_corta',
        'descripcion_larga',
        'existencia',
        'image'
    ];


    // Relación uno a muchos
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_categorias');
    }

    // Relación uno a muchos
    public function inventarios()
    {
        return $this->hasMany(Inventarios::class, 'id_productos');
    }

    public function cotizaciones()
    {
        return $this->hasMany(Cotizaciones::class, 'id_productos');
    }

    public function compras()
    {
        return $this->hasMany(Compras::class, 'id_productos');
    }

    public function existencia()
    {
        // Sumar el valor del campo 'existencia' con el total calculado a partir de los inventarios
        $existenciaInicial = $this->existencia;
        $existenciaInventarios = $this->inventarios->sum(function ($inventario) {
            return $inventario->movimiento === 'Entrada' ? $inventario->cantidad : -$inventario->cantidad;
        });

        return $existenciaInicial + $existenciaInventarios;
    }

    public function cotizacion_producto()
    {
        return $this->hasMany(Cotizacion_Producto::class, 'id_productos');
    }

    public function venta_producto()
    {
        return $this->hasMany(Venta_Productos::class, 'id_productos');
    }
}
