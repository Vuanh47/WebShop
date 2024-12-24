<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Address extends Model
{
    use HasFactory;
    protected $table ='address';
    protected $fillable =[
        'customer_id',
        'name',
        'phone',
        'address',
        'address_detail',


    ];
 

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
