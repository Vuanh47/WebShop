<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    // App\Models\Wishlist.php

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id'); // 'customer_id' là khóa ngoại
    }

    use HasFactory;
    protected $fillable =[
        'name',
        'price',
        'thumb',
        'active',
        'customer_id',
        'product_id',

    ];
}
