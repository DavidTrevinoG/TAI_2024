<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventarios extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = [
        'id_productos',
        'fecha_salida',
        'fecha_entrada',
        'movimiento',
        'motivo',
        'cantidad'
    ];

    // Relación uno a muchos
    public function producto()
    {
        return $this->belongsTo(Product::class, 'id_productos');
    }
}
