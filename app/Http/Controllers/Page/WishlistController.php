<?php 
namespace App\Http\Controllers\Page;

use App\Http\Service\Menu\MenuService;
use App\Http\Service\Wishlist\WishlistService;
use App\Http\Service\Product\ProductService;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController{
    protected $menuService;
    protected $productService;
    protected $wishlistService;


    public function __construct(MenuService $menuService,ProductService $productService,WishlistService $wishlistService){
        $this->menuService = $menuService;
        $this->productService = $productService;
        $this->wishlistService = $wishlistService;
    }
    public function store($id){
        $product = Product::find($id);
        $result = $this->wishlistService->creat($product);
 
        return   redirect()->route('wishlist');
     }
    public function index(){
        $count = Wishlist::count();
        return view('pages.wishlist',[
            'menus' => $this->menuService->getParent(),
            'title' => 'Wishlist',
            'wishlist' => $this->wishlistService->getAll(),
            'count' => $count
        ]);
    }
    public function remove($id){
        // Sử dụng findOrFail để ném lỗi nếu không tìm thấy sản phẩm
        $wishlistItem = Wishlist::findOrFail($id);
    
        // Xóa sản phẩm
        $wishlistItem->delete();
    
        // Chuyển hướng lại với thông báo thành công
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
    
}