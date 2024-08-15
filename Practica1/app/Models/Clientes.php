<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'direccion',
        'rfc',
        'razon_social',
        'codigo_postal',
        'regimen_fiscal'
    ];

    // Relación uno a muchos
    public function cotizaciones()
    {
        return $this->hasMany(Cotizaciones::class, 'id_clientes');
    }

    public function ventas()
    {
        return $this->hasMany(Ventas::class, 'id_clientes');
    }
}
