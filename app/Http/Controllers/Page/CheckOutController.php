<?php

namespace App\Http\Controllers\Page;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Product\ProductService;
use App\Models\Wishlist;

class CheckOutController{
    protected $menuService;
    protected $productService;

    public function __construct(MenuService $menuService,ProductService $productService){
        $this->menuService = $menuService;
        $this->productService = $productService;

    }
    public function index(){
        $count = Wishlist::count();
        return view('pages.checkout',[
            'title' => 'Check Out',
            'menus' => $this->menuService->getParent(),
            'count' => $count
        ]);
    }
}