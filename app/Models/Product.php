<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table ='products';

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
        'menu_id'

    ];

    public function orderDetails()
    {
        return $this->belongsToMany(OrderDetail::class, 'order_product')
        ->withPivot('quantity', 'price');
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product', 'product_id', 'cart_id')
                    ->withPivot('quantity');
    }
 
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details')
                    ->withPivot('quantity', 'price');
    }
    
    
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'product_id');
    }
}
