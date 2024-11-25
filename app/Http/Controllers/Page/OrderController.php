<?php

namespace App\Http\Controllers\Page;

use App\Http\Requests\Blog\CreateFormRequest;
use App\Http\Requests\Order\CreateFormRequest as OrderCreateFormRequest;
use App\Http\Requests\Voucher\CreateFormRequest as VoucherCreateFormRequest;
use App\Http\Service\Cart\CartService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Order\OrderService;
use App\Http\Service\Product\ProductService;
use App\Mail\OrderPlacedMail;
use App\Models\Cart;
use App\Models\OderDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Voucher;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use function Laravel\Prompts\alert;

class OrderController{
    protected $menuService;
    protected $productService;
    protected $orderService;
    protected $cartService;



    public function __construct(MenuService $menuService,CartService $cartService,ProductService $productService,OrderService $orderService){
        $this->menuService = $menuService;
        $this->orderService = $orderService;
        $this->productService = $productService;
        $this->cartService = $cartService;

    }

    public function index(Request $request){
       
        $subtotal = $request->input('subtotal', 0); 
        $discount = $request->input('discount', 0); 
        $total = $request->input('total', 0);    
        $carts = explode(',', $request->input('selectedIds', '')); // Chuyển chuỗi ID thành mảng

        $customerID = session('customerID');
        $count = Wishlist::where('customer_id', $customerID)->count();
        $count_cart = Cart::where('customer_id',$customerID)->count();
        
        session()->put('cart_ids', $carts);

        $carts = Cart::whereIn('id', $carts)->get();
       
    
        return view('pages.order', [
            'title' => 'Order',
            'menus' => $this->menuService->getParent(),
            'carts' => $carts,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'type' => 0,

            'total' => $total,
            'count' => $count,
            
            'count_cart' => $count_cart,
        ]);
    }

   

    public function store(Request $request)
    {
        
        $result = $this->orderService->create($request);
    
        if ($result && is_object($result)) {
            $orderId = $result->id;
            $cartIds = session()->get('cart_ids');
    
            if (is_array($cartIds) && count($cartIds) > 0) {
                $carts = Cart::whereIn('id', $cartIds)->get();
                $customer_id = session()->get('customerID');
                $orderDetails = []; // Lưu chi tiết đơn hàng
    
                foreach ($carts as $cart) {
                    $orderDetail = OrderDetail::create([
                        'order_id' => $orderId,
                        'customer_id' => $customer_id,
                        'product_id' => $cart->product_id,
                        'quantity' => $cart->quantity,
                        'price' => $cart->price,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $orderDetails[] = $orderDetail;
    
                    $product = Product::find($orderDetail->product_id);
                    if ($product->quantity >= $orderDetail->quantity) {
                        $product->quantity -= $orderDetail->quantity;
                        $product->save();
                    } else {
                        return back()->withErrors("Sản phẩm {$product->name} không đủ số lượng!");
                    }
                }
    
                // Xóa các sản phẩm trong giỏ hàng sau khi đặt đơn hàng
                Cart::whereIn('id', $cartIds)->delete();
    
                // Gửi email
                try {
                    $customerEmail = $request->input('email');
                    if (!$customerEmail) {
                        return back()->withErrors('Email người nhận không hợp lệ.');
                    }
                    $orderDetailsCollection = collect($orderDetails); // Chuyển mảng thành Collection
                    Mail::to($customerEmail)->send(new OrderPlacedMail($orderDetailsCollection));
                } catch (\Exception $e) {
                    Log::error('Lỗi gửi email: ' . $e->getMessage());
                    return back()->withErrors('Lỗi khi gửi email: ' . $e->getMessage());
                }
    
                // Xóa session giỏ hàng và điều hướng
                session()->forget('cart_ids');
                return redirect()->route('order_details', $orderDetail->order_id)->with('success', 'Đặt hàng thành công!');
            } else {
                return back()->withErrors('Giỏ hàng trống!');
            }
        }
    
        return back()->withErrors('Đặt hàng không thành công!');
    }
    
    
    public function coupon(Request $request) {
        
        $request->validate([
            'code' => 'required|string|max:255',
            'subtotal' => 'required|numeric|min:0',
        ]);
    
        $voucher = Voucher::where('code', $request->code)->first();
        
        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá không hợp lệ.'
            ]);
        }
    
            // Kiểm tra nếu mã đã hết hạn
        if ($voucher->end_date && now()->greaterThan($voucher->end_date)) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá đã hết hạn.'
            ]);
        }

        // Kiểm tra số lượng còn lại
        if ($voucher->quantity <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá đã hết số lượng khả dụng.'
            ]);
        }

        $discountAmount = $voucher->value ?? 0;
        $type = $voucher->type;
        $subtotal = $request->input('subtotal'); 

        if ($subtotal > 0) {
            if ($type == 'percentage') {
                $total = $subtotal - ($subtotal * ($discountAmount / 100));
            } else {
                $total = $subtotal - $discountAmount;
            }
            $total = max($total, 0);
        } else {
            $total = 0;
        }
    
         // Giảm số lượng voucher
         $voucher->decrement('quantity');

        session([
            'discount' => $discountAmount,
            'type' => $type,
            'total' => $total
        ]);
    
        return response()->json([
            'success' => true,
            'discount' => number_format($discountAmount, 2),
            'subtotal' => number_format($subtotal, 2),
            'total' => number_format($total, 2),
            'type' => session('type'),  // loại giảm giá
            'message' => 'Mã giảm giá đã được áp dụng!'
        ]);
    }
    
}