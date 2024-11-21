<?php 
namespace App\Http\Controllers\Page;

use App\Http\Service\Cart\CartService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Wishlist\WishlistService;
use App\Http\Service\Product\ProductService;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController{
    protected $menuService;
    protected $productService;
    protected $wishlistService;

    protected $cartService;


    public function __construct(MenuService $menuService,ProductService $productService,CartService $cartService,WishlistService $wishlistService){
        $this->menuService = $menuService;
        $this->productService = $productService;
        $this->cartService = $cartService;
        $this->wishlistService = $wishlistService;

    }
    public function addToWishlist($id)
    {
        $product = Product::find($id);
        $result = $this->wishlistService->creat($product);

        if (!$result) {
            return redirect()->back()->with('error', session('error'));
        }

        return redirect()->route('wishlist')->with('success', session('success'));
    }
    public function index(){
        $customerID = session('customerID');
        $count = Wishlist::where('customer_id', $customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');
        $count_cart = cart::where('customer_id',$customerID)->count();
        return view('pages.wishlist',[
            'menus' => $this->menuService->getParent(),
            'title' => 'Wishlist',
            'wishlist' => $this->wishlistService->getAll(),
             'carts' => $this->cartService->getAll(),        
            'count' => $count,
            'total' => $total,
            'count_cart' => $count_cart,
        ]);
    }
    public function remove($id){
        $wishlistItem = Wishlist::findOrFail($id);
        $wishlistItem->delete();

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
    
}