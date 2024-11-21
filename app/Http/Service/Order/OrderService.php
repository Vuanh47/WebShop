<?php

namespace App\Http\Service\Order;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class OrderService {

    function store(){

    }

    public function getAll()
    {
        return Order::orderByDesc('id')
                    ->paginate(8);
    }
    
    public function getAllDetail()
    {
        $orderDetails = OrderDetail::with(['order', 'product', 'customer'])
        ->orderBy('created_at', 'desc')  // Sắp xếp theo thời gian từ mới nhất
        ->paginate(8);

    // Nhóm các đơn hàng theo order_id
     $orders = $orderDetails->groupBy('order_id');
        return $orders;
    }
    

    public function create($request)
{
    try {

        $orderCode = 'ORDER-' . strtoupper(bin2hex(random_bytes(4))); // Ví dụ: ORDER-1A2B3C4D
        $order = Order::create([
            'id' => $orderCode,
            'customer_id' => $request->input('customer_id'),
            'total_price' => $request->input('total'),
            'shipping_address' => $request->input('shipping_address'),
            'payment_method' => $request->input('payment_method'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'recipient_name' => $request->input('recipient_name'),
            'order_notes' => $request->input('order_notes'),
        ]);

        // Lưu thông báo thành công vào session
        Session::flash('success', 'Đặt Hàng Thành Công. Mã đơn hàng: ' . $orderCode);

        // Trả về đối tượng Order đã tạo
        return $order;
    } catch (\Exception $err) {
        // Lưu thông báo lỗi vào session
        Session::flash('error', $err->getMessage());

        return false;
    }
}

    
}