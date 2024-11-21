<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Cart extends Model
{
    use HasFactory;
    protected $table ='carts';
    protected $fillable =[
        'name',
        'price',
        'quantity',
        'thumb',
        'total',
        'customer_id',
        'product_id',


    ];
    // App\Models\Cart.php
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');  // Mối quan hệ nhiều-nhiều (Cart -> Product)
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
