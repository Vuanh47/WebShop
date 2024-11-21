<?php

namespace App\Http\Controllers\Page;

use App\Http\Requests\Blog\CreateFormRequest;
use App\Http\Requests\Order\CreateFormRequest as OrderCreateFormRequest;
use App\Http\Requests\Voucher\CreateFormRequest as VoucherCreateFormRequest;
use App\Http\Service\Cart\CartService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Order\OrderService;
use App\Http\Service\Product\ProductService;
use App\Models\Cart;
use App\Models\OderDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

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
        $subtotal = $request->input('subtotal', 1); 
        $discount = $request->input('discount', 1); 
        $total = $request->input('total', 2);       
        $carts = explode(',', $request->input('selectedIds', '')); // Chuyển chuỗi ID thành mảng

        $customerID = session('customerID');
        $count = Wishlist::where('customer_id', $customerID)->count();
        $count_cart = Cart::where('customer_id',$customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');
        session()->put('cart_ids', $carts);

        $carts = Cart::whereIn('id', $carts)->get();
       
    
        return view('pages.order', [
            'title' => 'Order Detail',
            'menus' => $this->menuService->getParent(),
            'carts' => $carts,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
            'count' => $count,
            
            'count_cart' => $count_cart,
        ]);
    }
    public function store(Request $request){
        $result = $this->orderService->create($request);

        if ($result && is_object($result)) {
            $orderId = $result->id;
            $cartIds = session()->get('cart_ids');

            if (is_array($cartIds) && count($cartIds) > 0) {
                $carts = Cart::whereIn('id', $cartIds)->get();
                $customer_id = session()->get('customerID');

                // Xử lý giỏ hàng và đơn hàng
                foreach ($carts as $cart) {
                    $orderDetail = OrderDetail::create([
                        'order_id' => $orderId,
                        'customer_id' => $customer_id,
                        'product_id' => $cart->product_id, // Lấy product_id từ giỏ hàng
                        'quantity' => $cart->quantity,
                        'price' => $cart->price,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                session()->forget('cart_ids');

                return redirect()->route('order_history')->with('success', 'Đặt hàng thành công!');
            } else {
                return back()->withErrors('Giỏ hàng trống!');
            }
        }

        return back()->withErrors('Đặt hàng không thành công!');
}

    
  
}