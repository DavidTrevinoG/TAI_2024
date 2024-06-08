<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = [
        'name',
        'category_id',
        'precio_venta',
        'precio_compra',
        'fecha_anadido',
        'color',
        'descripcion_corta',
        'descripcion_larga'
    ];


    // Relación uno a muchos
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relación uno a muchos
    public function inventarios()
    {
        return $this->hasMany(Inventarios::class);
    }
}
