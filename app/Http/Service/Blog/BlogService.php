<?php
namespace App\Http\Service\Blog;

use App\Models\Blog;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Wishlist;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class BlogService{

    public function getAll($productId = null){
        $query = Blog::query();
        if ($productId) {
            $query->where('product_id', $productId);
        }
        return $query->orderByDesc('id')->paginate(16);
    }

    public function create($request){    
        try {
            // Ghi log dữ liệu yêu cầu
            Log::info('Request data:', $request->all());

    
            // Tạo tài khoản mới
            Blog::create([
                'content' => (string) $request->input('content'),
                'star' => (int) $request->input('star'),
                'thumb' => (string) $request->input('thumb'),
                'customer_id' => (int) $request->input('customer_id'),
                'product_id' => (int) $request->input('product_id'),

            ]);
    
            Session::flash('success', 'Bình Luận Thành Công');
        } catch (\Exception $err) {
            Log::error('Registration error: ' . $err->getMessage()); // Ghi log lỗi
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    

}