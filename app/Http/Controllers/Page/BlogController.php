<?php

namespace App\Http\Controllers\Page;

use App\Http\Requests\Blog\CreateFormRequest;
use App\Http\Service\Blog\BlogService;
use App\Http\Service\Cart\CartService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Product\ProductService;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class BlogController{
    protected $menuService;
    protected $productService;
    protected $blogService;
    protected $cartService;


    public function __construct(MenuService $menuService,ProductService $productService,CartService $cartService,BlogService $blogService){
        $this->menuService = $menuService;
        $this->productService = $productService;
        $this->blogService = $blogService;
        $this->cartService = $cartService;



    }
    public function index(){ 

        $products = Product::with(['blogs'])->get();
        $customerID = session('customerID');
        $customer = Customer::find($customerID);

        $count = Wishlist::where('customer_id', $customerID)->count();
        $count_cart = Cart::where('customer_id',$customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');
        // Lấy các blog chung, hoặc tất cả các blog nếu không cần lọc theo sản phẩm
        $blogs = $this->blogService->getAll();

        return view('pages.blog', [
            'title' => 'Blog',
            'menus' => $this->menuService->getParent(),
            'count' => $count,
            'customer' => $customer,

            'carts' => $this->cartService->getAll(),
            'products' => $products,
            'blogs' => $blogs, 
            'total' => $total,
            'count_cart' => $count_cart,
    ]);
}

    
    
    public function detail($id){
   
        $product = Product::find($id);
        $customerID = session('customerID');
        $customer = Customer::find($customerID);
        $count = Wishlist::where('customer_id', $customerID)->count();
        $count_cart = Cart::where('customer_id',$customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');
        $blogs = $product->blogs()->orderBy('created_at', 'desc')->paginate(4);

        return view('pages.blogDetail', [
            'title' => 'Blog Details',
            'menus' => $this->menuService->getParent(),
            'count' => $count,
            'carts' => $this->cartService->getAll(),
            'product' => $product,
            'customer' => $customer,
            'imageUrl' =>'',
            'customer_id' => $customerID,
            'blogs' => $blogs, 
            'total' => $total,
            'count_cart' => $count_cart,
    ]);
    }
    

    public function store(CreateFormRequest $request){
    
        $result = $this->blogService->create($request);

        return redirect()->back();
     }
    
     
}