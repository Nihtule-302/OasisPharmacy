<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderdItem extends Model
{
    protected $fillable = [
        'item_id',
        'product_id',
        'order_id',
    ];
    use HasFactory;

    public function pharmaceuticalProduct(): BelongsTo
    {
        return $this->belongsTo(PharmaceuticalProduct::class);
    }
    
    /*public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }*/
}
