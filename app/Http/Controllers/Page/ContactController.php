<?php

namespace App\Http\Controllers\Page;

use App\Http\Service\Customer\CustomerService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Product\ProductService;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Wishlist;

class ContactController{
    protected $menuService;
    protected $productService;
    protected $customerService;


    public function __construct(MenuService $menuService,ProductService $productService,CustomerService $customerService){
        $this->menuService = $menuService;
        $this->productService = $productService;
        $this->customerService = $customerService;

    }
    public function index(){
        $customerID = session('customerID');
        $customer = Customer::find($customerID);
        $count = Wishlist::where('customer_id', $customerID)->count();
        $carts = Cart::where('customer_id',$customerID)->get();
        $total = Cart::where('customer_id', $customerID)->sum('total');
        $count_cart = cart::where('customer_id',$customerID)->count();
       
        return view('pages.contact',[
            'title' => 'Contact',
            'count' => $count,
            'menus' => $this->menuService->getParent(),
            'customer' => $customer,
            'carts' => $carts,
            'total' => $total,
            'count_cart' => $count_cart,
        ]);
    }
}