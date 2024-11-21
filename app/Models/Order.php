<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use HasFactory;
    protected $table ='order';
    protected $primaryKey = 'id'; 
    public $incrementing = false; 
    protected $keyType = 'string';  
    protected $fillable =[
        'id',
        'customer_id',
        'total_price',  
        'shipping_status',
        'shipping_address',
        'payment_method',
        'email',
        'phone_number',
        'recipient_name',
        'order_notes',

    ];

 
    public function customer()
    {
        return $this->belongsTo(Customer::class);  // Mối quan hệ một-nhiều (Order -> Customer)
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details')
                    ->withPivot('quantity', 'price');
    }
    
    
}
