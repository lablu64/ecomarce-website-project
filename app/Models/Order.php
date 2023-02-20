<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'userid',
        'shoping_phonNumber',
        'shoping_city',
        'shoping_posterCode',
        'product_id',
        'quantity',
        'total_Price',
        
      
    ];
}
