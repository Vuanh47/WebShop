<?php
namespace App\Http\Service\Customer;

use App\Models\Customer;
use App\Models\Menu;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CustomerService{

   

    public function getAll(){
        return Menu::orderByDesc('id')->paginate(20);
    }
    public function create($request){    
        try {
            // Ghi log dữ liệu yêu cầu
            Log::info('Request data:', $request->all());
    
            // Kiểm tra xem tài khoản đã tồn tại chưa
            $existingAccount = Customer::where('email', $request->input('email'))->first();
            if ($existingAccount) {
                Session::flash('error', 'Tài Khoản Đã Tồn Tại'); // Thông báo lỗi
                return false;
            }
    
            // Tạo tài khoản mới
            Customer::create([
                'name' => (string) $request->input('name'),
                'email' => (string) $request->input('email'),
                'password' => Hash::make($request->input('password')), // Hash mật khẩu
                'phone' => (string) $request->input('phone'),
                'address' => (string) $request->input('address'),
            ]);
    
            Session::flash('success', 'Tạo tài khoản thành công');
        } catch (\Exception $err) {
            Log::error('Registration error: ' . $err->getMessage()); // Ghi log lỗi
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    

}