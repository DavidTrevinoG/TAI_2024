<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventarios extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'category_id',
        'fecha_entrada',
        'fecha_salida',
        'motivo',
        'tipo_movimiento',
        'cantidad'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function producto()
    {
        return $this->belongsTo(Product::class);
    }
}
