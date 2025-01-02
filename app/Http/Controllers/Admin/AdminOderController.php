<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Service\Cart\CartService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Order\OrderService;
use App\Http\Service\Vouchers\VoucherService;
use App\Models\CancelOrder;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOderController extends Controller
{
    protected $voucher;
    protected $cartService;
    protected $menuService;
    protected $orderService;


    public function __construct(VoucherService $voucher, CartService $cartService, MenuService $menuService, OrderService $orderService)
    {
        $this->voucher = $voucher;
        $this->cartService = $cartService;
        $this->menuService = $menuService;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $statusMapping = [
            'Pending' => 'Đang chờ xử lý',
            'Processing' => 'Đang xử lý',
            'Shipped' => 'Đã giao hàng',
            'Out for Delivery' => 'Đang giao hàng',
            'Delivered' => 'Đã giao thành công',
            'Cancelled' => 'Đã hủy',
        ];
        $orders = $this->orderService->getAll();
        return view('admin.order.list', [
            'title' => "Danh sách Đơn Hàng",
            'orders' => $orders,
            'menus' => $this->menuService->getAll(),
            'statusMapping' => $statusMapping,
        ]);
    }
    public function search(Request $request)
    {
        $order_type = $request->input('order_type');

        // Khởi tạo truy vấn
        $orders = Order::query();

        // Nếu có 'order_type', tìm kiếm theo trạng thái đơn hàng
        if (!empty($order_type)) {
            $orders = $orders->where('shipping_status', 'LIKE', "%{$order_type}%");
        }

        $orders = $orders->paginate(10);

        // Mảng ánh xạ trạng thái đơn hàng
        $statusMapping = [
            'Pending' => 'Đang chờ xử lý',
            'Processing' => 'Đang xử lý',
            'Shipped' => 'Đã giao hàng',
            'Out for Delivery' => 'Đang giao hàng',
            'Delivered' => 'Đã giao thành công',
            'Cancelled' => 'Đã hủy',
        ];

        return view('admin.order.list', [
            'title' => "Danh sách Đơn Hàng",
            'orders' => $orders,
            'menus' => $this->menuService->getAll(),
            'statusMapping' => $statusMapping,
            'order_type' => $order_type,
        ]);
    }


    public function cancel()
    {
        $statusMapping = [
            'Pending' => 'Đang chờ xử lý',
            'Processing' => 'Đang xử lý',
            'Shipped' => 'Đã giao hàng',
            'Out for Delivery' => 'Đang giao hàng',
            'Delivered' => 'Đã giao thành công',
            'Cancelled' => 'Đã hủy',
        ];
        $orders = $this->orderService->getAll();

        $orderCancel = CancelOrder::get();
        return view('admin.order.orderCancel', [
            'title' => "Danh sách Đơn Hàng",
            'orders' => $orders,
            'menus' => $this->menuService->getAll(),
            'statusMapping' => $statusMapping,
            'orderCancel' => $orderCancel,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $orderCancel = CancelOrder::findOrFail($id);

        $orderCancel->status = $request->status;
        $orderCancel->save();

        if ($request->status == 'approved') {
            $order = Order::where('id', $orderCancel->order_id)->first();

            if ($order) {
                $order->shipping_status = 'Cancelled';
                $order->save();
            }
        }

        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật!');
    }



    public function nextStatus($orderId)
    {
        // Lấy đơn hàng
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['success' => false], 404);
        }

        // Cập nhật trạng thái đơn hàng theo logic của bạn
        $statusMapping = [
            'Pending' => 'Processing',
            'Processing' => 'Shipped',
            'Shipped' => 'Out for Delivery',
            'Out for Delivery' => 'Delivered',
            'Delivered' => 'Cancelled',
            'Cancelled' => 'Pending',
        ];

        // Lấy trạng thái hiện tại và cập nhật
        $currentStatus = $order->shipping_status;
        $newStatus = $statusMapping[$currentStatus] ?? 'Pending';
        $order->shipping_status = $newStatus;
        $order->save();

        // Trả về JSON với trạng thái mới và màu sắc tương ứng
        $statusClasses = [
            'Pending' => 'warning',
            'Processing' => 'info',
            'Shipped' => 'primary',
            'Out for Delivery' => 'info',
            'Delivered' => 'success',
            'Cancelled' => 'danger',
        ];

        return response()->json([
            'success' => true,
            'statusText' => $statusMapping[$newStatus] ?? 'N/A',
            'statusClass' => $statusClasses[$newStatus] ?? 'secondary',
        ]);
    }

    public function detail($id)
    {
        // Tìm kiếm đơn hàng theo order_id
        $order = Order::findOrFail($id);

        // Lấy danh sách chi tiết đơn hàng
        $orderDetails = $order->orderDetails; // Truyền chi tiết đơn hàng liên quan

        // Mảng trạng thái
        $statusMapping = [
            'Pending' => 'Đang chờ xử lý',
            'Processing' => 'Đang xử lý',
            'Shipped' => 'Đã giao hàng',
            'Out for Delivery' => 'Đang giao hàng',
            'Delivered' => 'Đã giao thành công',
            'Cancelled' => 'Đã hủy',
        ];

        // Trả về view với dữ liệu cần thiết
        return view('admin.order.orderDetail', [
            'title' => "Chi Tiết Đơn Hàng",
            'order' => $order,
            'orderDetails' => $orderDetails, // Truyền chi tiết đơn hàng
            'menus' => $this->menuService->getAll(),
            'statusMapping' => $statusMapping,
        ]);
    }

    public function logout(Request $request)
    {

        Auth::guard()->logout();
        // Xóa thông tin user_name khỏi session
        session()->forget('user_name');

        // Xóa tất cả thông tin phiên
        $request->session()->invalidate();

        // Tạo lại phiên
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
    }
}
