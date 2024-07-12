<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cotizacion_producto extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = [
        'id_cotizaciones',
        'id_productos',
        'cantidad'
    ];

    // Relación uno a muchos
    public function cotizaciones()
    {
        return $this->belongsTo(Cotizaciones::class, 'id_cotizaciones');
    }

    public function productos()
    {
        return $this->belongsTo(Product::class, 'id_productos');
    }
}
