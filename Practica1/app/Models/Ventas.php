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
        'id_formapago',
        'cambio',
        'subtotal',
        'iva',
        'total'
    ];

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'id_vendedores');
    }

    public function formapago()
    {
        return $this->belongsTo(FormaPago::class, 'id_formapago');
    }

    public function venta_productos()
    {
        return $this->hasMany(Venta_Productos::class, 'id_ventas');
    }

    public function cliente()
    {
        return $this->belongsTo(Clientes::class);
    }
}
