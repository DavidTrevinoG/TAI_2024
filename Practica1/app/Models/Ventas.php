<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'category_id',
        'cliente_id',
        'cantidad',
        'fecha_venta',
        'subtotal',
        'iva',
        'total'
    ];

    public function producto()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Clientes::class);
    }
}
