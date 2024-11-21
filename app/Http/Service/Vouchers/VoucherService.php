<?php
namespace App\Http\Service\Vouchers;
use App\Models\Voucher;
use Illuminate\Support\Facades\Session;

class VoucherService{

    public function creat($request){
        try {
  
            Voucher::create([
                'code' => $request->input('code'), // Giữ nguyên chuỗi
                'quantity' => (int) $request->input('quantity'), // Chuyển sang kiểu số nguyên
                'type' => $request->input('type'), // Giữ nguyên chuỗi
                'active' => (int) $request->input('active'), // Chuyển sang kiểu boolean
                'start_date' => $request->input('start_date'), // Định dạng ngày
                'end_date' => $request->input('end_date'), // Định dạng ngày
                'conditions' => $request->input('conditions'), // Giữ nguyên chuỗi
                'value' => (float) $request->input('value'), // Thêm trường 'value'
            ]);
            
  
            Session::flash('success', 'Tạo Voucher Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    function getAll(){
        return Voucher::orderByDesc('id')->paginate(20);
    }
}