<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Blog extends Model
{
    use HasFactory;
    protected $table ='blogs';
    protected $fillable =[
        'customer_id',
        'product_id',
        'star',
        'thumb',
        'content',
        


    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // App\Models\Blog.php
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
