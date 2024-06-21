<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = [
        'nombre'
    ];

    // Relación uno a muchos
    public function products()
    {
        return $this->hasMany(Product::class, 'id_categorias');
    }
}
