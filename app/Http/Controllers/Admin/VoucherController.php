<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Voucher\CreateFormRequest;
use App\Http\Service\Cart\CartService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Vouchers\VoucherService;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller{
    protected $voucher;
    protected $cartService;
    protected $menuService;


    public function __construct(VoucherService $voucher,CartService $cartService,MenuService $menuService){
        $this->voucher = $voucher;
        $this->cartService = $cartService;
        $this->menuService = $menuService;

    }
    public function create(){
        return view('admin.vouchers.add',[
            'title' => 'Thêm Voucher',
        ]);
    }

    public function store(CreateFormRequest $request){
       $result = $this->voucher->creat($request);

       return redirect()->back();
    }

    public function index(){
        return view('admin.vouchers.list',[
            'title' =>'Danh Sách Voucher',
            'vouchers' => $this->voucher->getAll()    
        ]);
    }

    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        $vouchers = Voucher::all(); // Danh sách tất cả các danh mục
        return view('admin.vouchers.edit', [
            'voucher' => $voucher, // Truyền danh mục hiện tại
            'vouchers' => $vouchers, // Truyền danh sách các danh mục
            'title' => 'Chỉnh sửa Voucher',
          
        ]);
        

    }

    public function update(Request $request, $id)
    {
        // Xử lý cập nhật menu
        $voucher = Voucher::findOrFail($id);
        $voucher->update($request->all());
        return redirect()->route('voucher.list')->with('success', 'Voucher updated successfully!');
    }

    public function destroy($id)
    {
        $menu = Voucher::findOrFail($id);
        $menu->delete();
        return redirect()->route('voucher.list')->with('success', 'Voucher deleted successfully!');
    }

    
    
}