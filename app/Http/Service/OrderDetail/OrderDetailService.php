<?php

namespace App\Http\Service\OrderDetail;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class OrderDetailService {

    function store(){

    }

    public function getAll()
    {
        $customerID = session('customerID');
        return  OrderDetail::where('customer_id', $customerID)
            ->with(['order', 'product']) // Eager load liên kết order và product
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('order_id');// Nhóm theo order_id
    }
    
    

 

    
}