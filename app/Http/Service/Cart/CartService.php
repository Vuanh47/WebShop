<?php
namespace App\Http\Service\Cart;

use App\Models\Cart;
use App\Models\Menu;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Types\Relations\Car;

class CartService{





    public function getAll()
    {
        $customerID = session('customerID'); 
        return cart::with('customer')
                    ->where('customer_id', $customerID) 
                    ->orderByDesc('id')
                    ->paginate(6);
    }

    public function Subtotal(){
        $customerID = session('customerID'); 
        $carts = Cart::where('customer_id', $customerID)->get();
        $Subtotal = $carts->sum('total'); // Tính tổng tiền của giỏ hàng
        
        return $Subtotal;
    
    }

   
    public function create($product) {    
        try {
            $customerID = session('customerID');
    
            if (!$customerID) {
                return redirect()->back()->with('error', 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.');
            }
    
            $existingItem = Cart::where('product_id', $product->id)
                ->where('customer_id', $customerID)
                ->first();
    
            // Lấy giá trực tiếp từ price_sale của sản phẩm mà không cần chuyển đổi
            $price = intval(str_replace('.', '', $product->price_sale)); // Chuyển đổi về số nguyên
    
            // Kiểm tra xem giá có hợp lệ không
            if ($price <= 0) {
                return redirect()->back()->with('error', 'Giá sản phẩm không hợp lệ.');
            }
    
            if ($existingItem) {
                // Tăng số lượng lên 1
                $existingItem->quantity += 1; 
    
                // Tính toán tổng tiền dựa trên số lượng mới
                $existingItem->total = $price * $existingItem->quantity; // Tổng cũng nên là int
                $existingItem->save();
    
                return redirect()->back()->with('success', 'Sản phẩm đã được cập nhật trong giỏ hàng.');
            }
    
            // Tạo mới sản phẩm trong giỏ hàng
            Cart::create([
                'name' => $product->name,
                'price' => $price,  // Lưu price dưới dạng int
                'quantity' => 1,  // Mặc định số lượng là 1
                'total' => $price * 1,  // Tính total cho số lượng 1 và đưa về dạng int
                'product_id' => $product->id,
                'thumb' => $product->thumb, 
                'customer_id' => $customerID,  
            ]);
    
            return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    
        } catch (\Exception $err) {
            return redirect()->back()->with('error', 'Không thể thêm sản phẩm vào giỏ hàng: ' . $err->getMessage());
        }
    }
    
    
    
    
}