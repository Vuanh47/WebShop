<?php 
namespace App\Http\Controllers\Page;

use App\Http\Service\Menu\MenuService;
use App\Http\Service\Product\ProductService;

class DetailsController{
    protected $menuService;
    protected $productService;

    public function __construct(MenuService $menuService,ProductService $productService){
        $this->menuService = $menuService;
        $this->productService = $productService;

    }
    public function details(){

        return view('pages.single-product',[
            'title' => 'Detail Product',
            'menus' => $this->menuService->getParent()
        ]);
    }
}