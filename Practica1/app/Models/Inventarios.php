<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventarios extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = [
        'producto_id',
        'category_id',
        'fecha_entrada',
        'fecha_salida',
        'motivo',
        'tipo_movimiento',
        'cantidad'
    ];

    // Relación uno a muchos
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relación uno a muchos
    public function producto()
    {
        return $this->belongsTo(Product::class);
    }
}
