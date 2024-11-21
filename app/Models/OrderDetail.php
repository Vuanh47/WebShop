<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{

    use HasFactory;
    protected $table ='order_details';
    protected $fillable =[
        'order_id',
        'customer_id',
        'product_id',  
        'quantity',
        'price',

    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id'); // Hoặc thay 'cart_id' bằng tên trường đúng của bạn trong cơ sở dữ liệu
    }


    
  

}
