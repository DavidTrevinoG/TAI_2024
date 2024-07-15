<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_clientes',
        'id_vendedores',
        'id_formapagos',
        'cambio',
        'subtotal',
        'iva',
        'total'
    ];

    public function vendedor()
    {
        return $this->belongsTo(Vendedores::class, 'id_vendedores');
    }

    public function formapago()
    {
        return $this->belongsTo(FormaPago::class, 'id_formapagos');
    }

    public function venta_productos()
    {
        return $this->hasMany(Venta_Productos::class, 'id_ventas');
    }

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'id_clientes');
    }
}
