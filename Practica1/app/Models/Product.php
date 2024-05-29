<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'quantity',
        'price',
        'description',
        'category_id' // Agrega este campo
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
