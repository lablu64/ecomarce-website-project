<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shippinginfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'phone_number',
        'poster_name',
    ];

}
