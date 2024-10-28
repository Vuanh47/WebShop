<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;
    protected $fillable =[
        'name',
        'category',
        'description',
        'content',
        'active',
        'price',
        'price_sale',
        'thumb',
        'quality',
    ];
    
}
