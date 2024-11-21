<?php

namespace App\Http\Controllers\Page;

use App\Http\Service\Cart\CartService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Product\ProductService;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class ShopController{
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
        $products = $this->productService->getAll();
        $customerID = session('customerID');
        $count = Wishlist::where('customer_id', $customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');
        $count_cart = cart::where('customer_id',$customerID)->count();
        return view('pages.shop', [
            'title' => 'Shop',
            'menus' => $this->menuService->getParent(),
            'carts' => $this->cartService->getAll(),           
            'products' => $products,
            'count' => $count,
            'total' => $total,
            'count_cart' => $count_cart,
        ]);
    }
    
    public function search(Request $request)
    {
        $products = $this->productService->getAll();
        $customerID = session('customerID');
        $count = Wishlist::where('customer_id', $customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');
        $count_cart = cart::where('customer_id',$customerID)->count();
        $searchTerm = $request->input('query');
        $searchMenu_id  = $request->input('menu_id');

       
        $products = Product::query();
        if(!empty($searchTerm)){

            $products = $products->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        if (!empty($searchMenu_id)) {
            $products = $products->where('menu_id', $searchMenu_id);
        }
    
        $products = $products->paginate(10);
        return view('pages.shop', [
            'products' => $products,
            'searchTerm' => $searchTerm,
            'carts' => $this->cartService->getAll(),
            'title' => 'Shop',
            'menus' => $this->menuService->getParent(), 
            'count' => $count,
            'total' => $total,
            'count_cart' => $count_cart,
        ]);
    }
    

}