<?php

namespace App\Http\Controllers\Page;

use App\Http\Service\Cart\CartService;
use App\Http\Service\Customer\CustomerService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\OrderDetail\OrderDetailService;
use App\Http\Service\Product\ProductService;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Wishlist;

class OrderHistoryController{
    protected $menuService;
    protected $productService;
    protected $customerService;
    protected $cartService;

    protected $orderDetailService;


    public function __construct(MenuService $menuService,ProductService $productService,CustomerService $customerService,CartService $cartService,OrderDetailService $orderDetailService){
        $this->menuService = $menuService;
        $this->productService = $productService;
        $this->customerService = $customerService;
        $this->cartService = $cartService;
        $this->orderDetailService = $orderDetailService;



    }
        public function index(){
            $customerID = session('customerID');
            $orders = $this->orderDetailService->getAll();
           
            $customerID = session('customerID');
            $count = Wishlist::where('customer_id', $customerID)->count();
            $count_cart = Cart::where('customer_id',$customerID)->count();
            $total = Cart::where('customer_id', $customerID)->sum('total');
    
            return view('pages.order-history',[
                'title' => 'Order History',
                'menus' => $this->menuService->getParent(),
                'carts' => $this->cartService->getAll(),
                'orders' => $orders,
                'count' => $count,
                'total' => $total,
                'count_cart' => $count_cart,
            ]);
    }
}