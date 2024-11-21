<?php

namespace App\Http\Controllers\Page;

use App\Http\Service\Cart\CartService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Product\ProductService;
use App\Models\Cart;
use App\Models\Wishlist;

class AboutController{
    protected $menuService;
    protected $productService;
    protected $cartService;


    public function __construct(MenuService $menuService,ProductService $productService,CartService $cartService){
        $this->menuService = $menuService;
        $this->productService = $productService;
        $this->cartService = $cartService;


    }
    public function index(){
        $customerID = session('customerID');
        $count = Wishlist::where('customer_id', $customerID)->count();
        $count_cart = cart::where('customer_id',$customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');
        return view('pages.about-us',[
            'title' => 'About Us',
            'menus' => $this->menuService->getParent(),
            'carts' => $this->cartService->getAll(),  
            'count' => $count,
            'total' => $total,
            'count_cart' => $count_cart,
        ]);
    }
}