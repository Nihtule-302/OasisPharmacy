<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PharmaceuticalProduct extends Model
{
    protected $fillable = [
        'product_name',
        'expiration_date',
        'price',
        'description',
    ];
    use HasFactory;

    public function orderdItems(): HasMany
    {
        return $this->hasMany(OrderdItem::class);
    }

}
