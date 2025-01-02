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
    
        $orderDetails = OrderDetail::where('customer_id', $customerID)
            ->with(['order', 'product']) 
            ->orderBy('created_at', 'desc')
            ->paginate(8); // Phân trang 10 bản ghi mỗi trang
    
            $groupedOrderDetails = $orderDetails->getCollection()->groupBy('order_id');
    
        // Gắn tập hợp đã nhóm lại vào collection
        $orderDetails->setCollection($groupedOrderDetails);
    
        return $orderDetails;
    }
    
    
    public function get4()
    {
        $customerID = session('customerID');
    
        $orderDetails = OrderDetail::where('customer_id', $customerID)
            ->with(['order', 'product']) 
            ->orderBy('created_at', 'desc')
            ->paginate(4); // Phân trang 10 bản ghi mỗi trang
    
            $groupedOrderDetails = $orderDetails->getCollection()->groupBy('order_id');
    
        // Gắn tập hợp đã nhóm lại vào collection
        $orderDetails->setCollection($groupedOrderDetails);
    
        return $orderDetails;
    }
 

    
}