<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'order_date',
        'product_id',
        'quantity',
        'total_price',
        'status',
        'customer_comment',
    ];

    /**
     * Получить товар, который содержится в этом заказе.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
