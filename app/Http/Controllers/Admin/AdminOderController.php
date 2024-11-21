<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Service\Cart\CartService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Order\OrderService;
use App\Http\Service\Vouchers\VoucherService;
use App\Models\Menu;
use Illuminate\Http\Request;

class AdminOderController extends Controller
{
    protected $voucher;
    protected $cartService;
    protected $menuService;
    protected $orderService;


    public function __construct(VoucherService $voucher,CartService $cartService,MenuService $menuService,OrderService $orderService){
        $this->voucher = $voucher;
        $this->cartService = $cartService;
        $this->menuService = $menuService;
        $this->orderService = $orderService;

    }

    public function index(){
        $orders = $this->orderService->getAllDetail();
        return view('admin.order.list',[
            'title' => "Danh sách Đơn Hàng",
            'orders' => $orders,
            'menus' => $this->menuService->getAll(),
        ]);
    }

}