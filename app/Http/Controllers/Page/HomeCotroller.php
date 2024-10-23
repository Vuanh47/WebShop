<?php

namespace App\Http\Controllers\Page;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Product\ProductService;
class HomeCotroller{
    protected $menuService;
    protected $productService;

    public function __construct(MenuService $menuService,ProductService $productService){
        $this->menuService = $menuService;
        $this->productService = $productService;

    }
    public function index()
    {
        $menus = $this->menuService->getParent1()->paginate(10); // Lấy 10 mục mỗi trang
        return view('pages.index', [
            'title' => 'Trang Chủ',
            'menus' => $menus
        ]);
    }
    
}