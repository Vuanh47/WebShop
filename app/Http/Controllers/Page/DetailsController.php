<?php 
namespace App\Http\Controllers\Page;

use App\Http\Service\Menu\MenuService;
use App\Http\Service\Product\ProductService;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class DetailsController{
    protected $menuService;
    protected $productService;

    public function __construct(MenuService $menuService,ProductService $productService){
        $this->menuService = $menuService;
        $this->productService = $productService;

    }
    public function details($id)
    {
        $product = Product::find($id); // Sử dụng find hoặc findOrFail
        $count = Wishlist::count();
        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }
    
        // Đếm số sản phẩm khác trong cùng danh mục
        $countRelatedPro = Product::where('category', $product->category)
                        ->where('id', '!=', $product->id) // Loại trừ sản phẩm hiện tại
                        ->count();
    
        return view('pages.detail-product', [
            'title' => 'Detail Product',
            'menus' => $this->menuService->getParent(),
            'product' => $product,
            'countRelatedPro' => $countRelatedPro,
            'count' => $count // Truyền $count vào view
        ]);
    }
    


    
}