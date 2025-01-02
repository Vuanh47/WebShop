<?php

namespace App\Http\Controllers\Page;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Product\ProductService;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Wishlist;

class CheckOutController{
    protected $menuService;
    protected $productService;

    public function __construct(MenuService $menuService,ProductService $productService){
        $this->menuService = $menuService;
        $this->productService = $productService;

    }
    public function index(){
        $customerID = session('customerID');
        $customer = Customer::find($customerID);
        $carts = Cart::where('customer_id',$customerID)->get();
        $count = Wishlist::where('customer_id', $customerID)->count();
        $count_cart = cart::where('customer_id',$customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');
        return view('pages.checkout',[
            'title' => 'Check Out',
            'menus' => $this->menuService->getParent(),
            'customer' => $customer,
            'count' => $count,
            'total' => $total,
            'count_cart' => $count_cart,
            'carts' => $carts,

        ]);
    }
}