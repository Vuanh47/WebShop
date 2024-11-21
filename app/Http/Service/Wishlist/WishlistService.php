<?php
namespace App\Http\Service\Wishlist;

use App\Models\Menu;
use App\Models\Wishlist;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class WishlistService{


// App\Http\Service\Wishlist\WishlistService.php


    public function getAll()
    {
        $customerID = session('customerID'); // Lấy customerID từ session
        return Wishlist::with('customer')
                    ->where('customer_id', $customerID) // Lọc theo customer_id
                    ->orderByDesc('id')
                    ->paginate(6);
    }

   

    public function creat($product) {    
        try {
            // Lấy customerID từ session
            $customerID = session('customerID');
            if (!$customerID) {
                Session::flash('error', 'Bạn cần đăng nhập để thêm sản phẩm vào danh sách yêu thích.');
                return false;
            }
    
            // Kiểm tra xem sản phẩm đã tồn tại trong danh sách yêu thích hay chưa
            $existingItem = Wishlist::where('name', $product->name)
                ->where('customer_id', $customerID) // Kiểm tra theo customer_id
                ->first();
        
            if ($existingItem) {
                Session::flash('error', 'Sản phẩm đã có trong danh sách yêu thích');
                return false;
            }
        
            Wishlist::create([
                'name' => $product->name,
                'price' => $product->price,
                'thumb' => $product->thumb, 
                'active' => $product->active, 
                'customer_id' => $customerID, 
                'product_id' => $product->id,
            ]);
        
            Session::flash('success', 'Tạo Danh Sách Yêu Thích Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    


}