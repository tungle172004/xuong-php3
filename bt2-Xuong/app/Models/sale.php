<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id'  ,
        'total_amount',
        'quantity'    ,
        'price'       ,
        'tax'         ,
        'final_amount',
        'user_id'     ,
    ];
}
