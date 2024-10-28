<?php
namespace App\Http\Service\Wishlist;

use App\Models\Menu;
use App\Models\Wishlist;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class WishlistService{


    public function getAll(){
        return Wishlist::orderByDesc('id')->paginate(6);
    }
    public function creat($product) {    
        try {
            // Kiểm tra xem sản phẩm đã tồn tại trong danh sách yêu thích hay chưa
            $existingItem = Wishlist::where('name', $product->name)->first();
    
            if ($existingItem) {
                Session::flash('error', 'Sản phẩm đã có trong danh sách yêu thích');
                return false;
            }
    
            Wishlist::create([
                'name' => $product->name,
                'price' => $product->price,
                'thumb' => $product->thumb, 
                'active' => $product->active, 
            ]);
    
            Session::flash('success', 'Tạo Danh Sách Yêu Thích Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    


}