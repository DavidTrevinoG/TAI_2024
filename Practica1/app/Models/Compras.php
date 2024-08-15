<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = [
        'id_proveedores',
        'id_productos',
        'id_forma_pago',
        'cantidad',
        'precio',
        'descuento',
        'total'
    ];

    public function productos()
    {
        return $this->belongsTo(Product::class, 'id_productos');
    }

    public function proveedores()
    {
        return $this->belongsTo(Proveedores::class, 'id_proveedores');
    }

    public function formapago()
    {
        return $this->belongsTo(FormaPago::class, 'id_forma_pago');
    }
}
