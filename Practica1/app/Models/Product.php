<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inventarios()
    {
        return $this->hasMany(Inventarios::class);
    }
}
