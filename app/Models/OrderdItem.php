<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderdItem extends Model
{
    protected $fillable = [
        'item_id',
        'product_id',
        'order_id',
    ];
    use HasFactory;
}
