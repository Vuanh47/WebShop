<?php

namespace App\Http\Controllers\Page;

use App\Http\Service\Cart\CartService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Product\ProductService;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Slider;
use App\Models\Wishlist;

class HomeCotroller{
    protected $menuService;
    protected $productService;
    protected $cartService;


    public function __construct(MenuService $menuService,ProductService $productService,CartService $cartService){
        $this->menuService = $menuService;
        $this->productService = $productService;
        $this->cartService = $cartService;


    }
    public function index()
    {
        $sliders = Slider::all();
        $customerID = session('customerID');
        $count = Wishlist::where('customer_id', $customerID)->count();
        $count_cart = Cart::where('customer_id',$customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');

        $menus = $this->menuService->getParent(); // Lấy 10 mục mỗi trang
        return view('pages.index', [
            'title' => 'Trang Chủ',
            'menus' => $menus,
            'sliders' => $sliders,
            'carts' => $this->cartService->getAll(),
            'count' => $count,
            'total' => $total,
            'count_cart' => $count_cart,
        ]);
    }

    
    
}