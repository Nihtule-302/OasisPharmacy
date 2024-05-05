<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderdItem extends Model
{
    protected $fillable = [
        'product_id',
        'order_id',
        'quantity',
    ];
    use HasFactory;

    public function pharmaceuticalProduct(): HasMany
    {
        return $this->hasMany(PharmaceuticalProduct::class);
    }
    
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
