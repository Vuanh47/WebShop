<?php

namespace App\Http\Controllers\Page;

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

class DetailsController
{
    protected $menuService;
    protected $productService;
    protected $cartService;
    protected $blogService;


    public function __construct(MenuService $menuService, BlogService $blogService, ProductService $productService, CartService $cartService)
    {
        $this->menuService = $menuService;
        $this->productService = $productService;
        $this->cartService = $cartService;
        $this->blogService = $blogService;
    }
    public function details($id)
    {
        $customerID = session('customerID');
        $customer = Customer::find($customerID);

        if (!$customerID) {
            $customerID = ''; // Nếu không tìm thấy khách hàng,
        }

        $product = Product::find($id);
        $count = Wishlist::where('customer_id', $customerID)->count();
        $count_cart = Cart::where('customer_id', $customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');
        $blogs = $this->blogService->getAll($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }

        // Đếm số sản phẩm khác trong cùng danh mục
        $countRelatedPro = Product::where('category', $product->category)
            ->where('id', '!=', $product->id) // Loại trừ sản phẩm hiện tại
            ->count();

        $productsRelated = Product::where('category', $product->category)
            ->where('id', '!=', $product->id) // Loại trừ sản phẩm hiện tại
            ->limit(4)
            ->get();

        return view('pages.detail-product', [
            'title' => 'Detail Product',
            'menus' => $this->menuService->getParent(),
            'product' => $product,
            'carts' => $this->cartService->getAll(),
            'blogs' => $blogs,
            'countRelatedPro' => $countRelatedPro,
            'productsRelated' => $productsRelated,
            'customer' => $customer,
            'imageUrl' => '',
            'customer_id' => $customerID,
            'count' => $count,
            'total' => $total,
            'count_cart' => $count_cart,
        ]);
    }
}
