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
use App\Models\OrderDetail;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class OrderDetailController{
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

    public function index($id)
    {
    
        $order_details = OrderDetail::where('order_id', $id)->get();
       
        $customerID = session('customerID');
        $count = Wishlist::where('customer_id', $customerID)->count();
        $count_cart = Cart::where('customer_id',$customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');
        
        return view('pages.order-detail', [
            'title' => 'Order Detail',
            'menus' => $this->menuService->getParent(),
            'carts' => $this->cartService->getAll(),
            'order_details' => $order_details,  
            'count' => $count,
            'total' => $total,
            'count_cart' => $count_cart,
        ]);
    }
    

    public function list(){
        
    }

}