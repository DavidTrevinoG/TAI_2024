<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'telefono',
        'direccion',
        'rfc'
    ];

    public function inventarios()
    {
        return $this->hasMany(Inventarios::class);
    }
}
