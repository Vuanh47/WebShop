<?php

namespace App\Http\Controllers\Page;

use App\Http\Service\Cart\CartService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Product\ProductService;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Voucher;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class CartController{
    protected $cartService;
    protected $productService;

    protected $menuService;


    public function __construct(CartService $cartService,MenuService $menuService,ProductService $productService){
        $this->cartService = $cartService;
        $this->productService = $productService;
        $this->menuService = $menuService;


    }
    public function index(){
        $customerID = session('customerID');
        $count = Wishlist::where('customer_id', $customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');
        $count_cart = cart::where('customer_id',$customerID)->count();
        return view('pages.shopping-cart',[
            'title' => 'Shopping Cart',
            'menus' => $this->menuService->getParent(),
            'carts' => $this->cartService->getAll(),
            'subtotal' => 0,
            'discount' => 0, 
            'type' =>0,         
            'total_cart' => 0,          
            'count' => $count,
            'total' => $total,
            'count_cart' => $count_cart,
        ]);
    }

    public function store($id){
        $product = Product::find($id); 
        
        if (!$product) {
            Session::flash('error', 'Sản phẩm không tồn tại.');
            return redirect()->back(); 
        }
       
        $cart = $this->cartService->create($product);
        if (!$cart) {
            return redirect()->back()->with('error', 'Không thể thêm sản phẩm vào giỏ hàng.');
        }
        
        return redirect()->route('cart');
     }

     public function remove($id){
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back()->with('success','Xóa thành công Giỏ Hàng');
     }

     public function update(Request $request) {
        
         // Giả sử bạn có một mô hình Cart để lưu trữ dữ liệu giỏ hàng
        $cart = Cart::where('customer_id', $request->customer_id)
        ->where('product_id', $request->product_id)
        ->first();
        
        $carts =Cart::where('customer_id', $request->customer_id);
        $Subtotal = $carts->sum('total');
        
        if ($cart) {
        // Cập nhật thông tin sản phẩm trong giỏ hàng
       
        $cart->name = $request->name;
        $cart->price = $request->price;
        $cart->quantity = $request->quantity;
        $cart->total = $request->total;
        $cart->save(); // Lưu các thay đổi

        // Xóa session nếu có
        session()->forget(['discount', 'type', 'total']); // Xóa session discount, type, và total

        } else {
            // Nếu không tìm thấy sản phẩm trong giỏ hàng, có thể thêm mới hoặc trả lỗi
            return response()->json([
                    'success' => false,
                    'message' => 'Sản phẩm không tồn tại trong giỏ hàng.',
                ]);
        }

        // Trả về phản hồi JSON
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công',
            'data' => [
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'total' => $request->total,
            'Subtotal' => $Subtotal, 
            ]
        ]);
    }
    public function coupon(Request $request) {
        $request->validate([
            'code' => 'required|string|max:255',
        ]);
    
        $voucher = Voucher::where('code', $request->code)->first();
        
        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá không hợp lệ.'
            ]);
        }
    


        $discountAmount = $voucher->value ?? 0;
        $type = $voucher->type;
        $subtotal = $this->cartService->Subtotal();
        
        if ($subtotal > 0) {
            if ($type == 'percentage') {
                $total = $subtotal - ($subtotal * ($discountAmount / 100));
            } else {
                $total = $subtotal - $discountAmount;
            }
            $total = max($total, 0);
        } else {
            $total = 0;
        }
    
        session([
            'discount' => $discountAmount,
            'type' => $type,
            'total' => $total
        ]);
    
        return response()->json([
            'success' => true,
            'discount' => number_format($discountAmount, 2),
            'subtotal' => number_format($subtotal, 2),
            'total' => number_format($total, 2),
            'message' => 'Mã giảm giá đã được áp dụng!'
        ]);
    }
    
    
    
    
    
    

    
    
}