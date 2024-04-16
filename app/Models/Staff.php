<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'staff_id',
        'role',
        'staff_name',
        'phone_number',
        'address',
        'email',
    ];
    use HasFactory;
}
