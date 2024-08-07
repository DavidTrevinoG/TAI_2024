<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizaciones extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = [
        'id_clientes',
        'id_productos',
        'vigencia',
        'cantidad',
        'comentarios'
    ];

    // Relación uno a muchos
    public function clientes()
    {
        return $this->belongsTo(Clientes::class, 'id_clientes');
    }

    public function productos()
    {
        return $this->belongsTo(Product::class, 'id_productos');
    }

    public function cotizacion_producto()
    {
        return $this->hasMany(Cotizacion_Producto::class, 'id_cotizaciones');
    }
}
