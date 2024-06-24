<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{

    use HasFactory;

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = [
        'nombre'
    ];

    // Relación uno a muchos
    public function compras()
    {
        return $this->hasMany(Compras::class, 'id_forma_pago');
    }
}
