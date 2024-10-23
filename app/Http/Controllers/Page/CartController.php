<?php

namespace App\Http\Controllers\Page;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Product\ProductService;
class CartController{
    protected $menuService;
    protected $productService;

    public function __construct(MenuService $menuService,ProductService $productService){
        $this->menuService = $menuService;
        $this->productService = $productService;

    }
    public function index(){

        return view('pages.shopping-cart',[
            'title' => 'Shopping Cart',
            'menus' => $this->menuService->getParent()
        ]);
    }
}