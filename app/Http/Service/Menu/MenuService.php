<?php
namespace App\Http\Service\Menu;

use App\Models\Menu;
use App\Models\Voucher;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class MenuService{

    public function getParent(){
        return Menu::where('parent_id',0)->get();
    }
    public function getParent1()
    {
        return Menu::where('parent_id', 0); // Trả về truy vấn Eloquent
    }


    public function getAll(){
        return Menu::orderByDesc('id')->paginate(20);
    }
    public function creat($request){    
        try {

             // Kiểm tra xem danh mục đã tồn tại chưa
             $existingMenu = Menu::where('name', $request->input('name'))->first();
             if ($existingMenu) {
                 Session::flash('error', 'Danh Mục Đã Tồn Tại'); // Thông báo lỗi
                 return false;
             }
            

            Menu::create([
                'name' =>(string) $request->input('name'),
                'parent_id' =>(string) $request->input('parent_id'),
                'description' =>(string) $request->input('description'),
                'thumb' =>(string) $request->input('thumb'),
                'active' =>(string) $request->input('active'),
                
            ]);

            Session::flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }


}