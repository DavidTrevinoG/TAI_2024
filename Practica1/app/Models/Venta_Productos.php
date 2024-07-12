<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class venta_productos extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = [
        'id_ventas',
        'id_productos',
        'cantidad'
    ];

    // Relación uno a muchos
    public function ventas()
    {
        return $this->belongsTo(Ventas::class, 'id_ventas');
    }

    public function productos()
    {
        return $this->belongsTo(Product::class, 'id_productos');
    }
}
