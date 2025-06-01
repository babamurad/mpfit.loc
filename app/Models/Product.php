<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price',
    ];

    /**
     * Получить категорию, к которой принадлежит товар.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Получить заказы, в которых есть этот товар.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
