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
    public function creat($product){    
        try {

            Wishlist::create([
                'name' => $product->name,
                'price' => $product->price,
                'thumb' => $product->thumb, // Hoặc trường tương ứng với hình ảnh
                'active' => $product->active, // Hoặc điều kiện khác nếu cần
                
            ]);

            Session::flash('success', 'Tạo Danh Sách Yêu Thích Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }


}