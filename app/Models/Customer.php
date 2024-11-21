<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table ='customers';
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
   
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

        // Định nghĩa mối quan hệ với Wishlist
        public function wishlists()
        {
            return $this->hasMany(Wishlist::class, 'customer_id'); // 'customer_id' là khóa ngoại
        }

        public function order()
        {
            return $this->hasMany(Wishlist::class, 'customer_id'); // 'customer_id' là khóa ngoại
        }
    
       // App\Models\Customer.php
        public function cart()
        {
            return $this->hasOne(Cart::class);  // Mối quan hệ một-một (Customer -> Cart)
        }

        
}
