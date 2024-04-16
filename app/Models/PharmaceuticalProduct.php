<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmaceuticalProduct extends Model
{
    protected $fillable = [
        'product_Id',
        'product_name',
        'expiration_date',
        'price',
        'description',
    ];
    use HasFactory;
}
