<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // Разрешаем массовое присвоение для поля 'name'

    /**
     * Получить товары, принадлежащие этой категории.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
