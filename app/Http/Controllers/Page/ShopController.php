<?php

namespace App\Http\Controllers\Page;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Product\ProductService;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class ShopController{
    protected $menuService;
    protected $productService;

    public function __construct(MenuService $menuService,ProductService $productService){
        $this->menuService = $menuService;
        $this->productService = $productService;

    }
    public function index()
    {
        $count = Wishlist::count();
        $products = $this->productService->getAll();
        
        // Trả về view với danh sách sản phẩm
        return view('pages.shop', [
            'title' => 'Shop',
            'menus' => $this->menuService->getParent(),
            'products' => $products,
            'count' => $count
        ]);
    }
    
    public function search(Request $request)
    {
        // Lấy từ khóa tìm kiếm
        $searchTerm = $request->input('query');
    
        // Tìm kiếm trong cột 'name' và 'description' của bảng sản phẩm
        $products = Product::where('name', 'LIKE', "%{$searchTerm}%")
                            ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                            ->paginate(10);
    
        // Trả về view với kết quả tìm kiếm
        return view('pages.shop', [
            'products' => $products,
            'searchTerm' => $searchTerm,
            'title' => 'Shop',
            'menus' => $this->menuService->getParent(), // Đảm bảo truyền menus nếu cần
        ]);
    }
    

}