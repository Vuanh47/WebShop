<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Service\Cart\CartService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Order\OrderService;
use App\Http\Service\Vouchers\VoucherService;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOderController extends Controller
{
    protected $voucher;
    protected $cartService;
    protected $menuService;
    protected $orderService;


    public function __construct(VoucherService $voucher,CartService $cartService,MenuService $menuService,OrderService $orderService){
        $this->voucher = $voucher;
        $this->cartService = $cartService;
        $this->menuService = $menuService;
        $this->orderService = $orderService;

    }

    public function index(){
        $statusMapping = [
            'Pending' => 'Đang chờ xử lý',
            'Processing' => 'Đang xử lý',
            'Shipped' => 'Đã giao hàng',
            'Out for Delivery' => 'Đang giao hàng',
            'Delivered' => 'Đã giao thành công',
            'Cancelled' => 'Đã hủy',
        ];
        $orders = $this->orderService->getAllDetail();
        return view('admin.order.list',[
            'title' => "Danh sách Đơn Hàng",
            'orders' => $orders,
            'menus' => $this->menuService->getAll(),
            'statusMapping' => $statusMapping,
        ]);
    }

    public function nextStatus(Request $request, $id)
    {
        $statusMapping = [
            'Pending' => 'Đang chờ xử lý',
            'Processing' => 'Đang xử lý',
            'Shipped' => 'Đã giao hàng',
            'Out for Delivery' => 'Đang giao hàng',
            'Delivered' => 'Đã giao thành công',
            'Cancelled' => 'Đã hủy',
        ];
        $order = Order::findOrFail($id);
        // Danh sách các trạng thái theo thứ tự
        $statuses = ['Pending', 'Processing', 'Shipped', 'Out for Delivery', 'Delivered', 'Cancelled'];
        // Lấy trạng thái hiện tại
        $currentStatus = $order->shipping_status;
        // Tìm trạng thái tiếp theo
        $currentIndex = array_search($currentStatus, $statuses);

        if ($currentIndex !== false && $currentIndex < count($statuses) - 1) {
            $order->shipping_status = $statuses[$currentIndex + 1]; // Trạng thái tiếp theo
            $order->save();

            return redirect()->route('order.list')->with('success', 'Trạng thái đã được cập nhật!');
        }

        return redirect()->back()->with('error', 'Không thể chuyển trạng thái!');
    }

    public function detail($id){       
        $order = Order::findOrFail($id);
        $statusMapping = [
            'Pending' => 'Đang chờ xử lý',
            'Processing' => 'Đang xử lý',
            'Shipped' => 'Đã giao hàng',
            'Out for Delivery' => 'Đang giao hàng',
            'Delivered' => 'Đã giao thành công',
            'Cancelled' => 'Đã hủy',
        ];
        return view('admin.order.orderDetail',[
            'title' => "Danh sách Đơn Hàng",
            'order' => $order,
            'orderDetails' => $order->orderDetails, // Truyền chi tiết đơn hàng
            'menus' => $this->menuService->getAll(),
            'statusMapping' => $statusMapping,
        ]);
    }
}