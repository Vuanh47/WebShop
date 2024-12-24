<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelOrder extends Model
{
    protected $table = 'cancel_orders';

    use HasFactory;
    protected $fillable = [
        'order_id',
        'cancel_reason',
        'other_cancel_reason',
        'status',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
