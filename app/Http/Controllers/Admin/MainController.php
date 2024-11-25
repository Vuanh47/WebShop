<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use  App\Http\Controllers\Admin;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    
    function index(){      
        $count_order = Order::count();  
        $total_price = Order::sum('total_price');
        $count_customer = Customer::count();
        return view('admin.home',[
            'title' => 'Trang Quản Trị Admin',
            'total_price' => $total_price,
            'count_order' => $count_order,
            'count_customer' => $count_customer,

        ]);
    }
}
