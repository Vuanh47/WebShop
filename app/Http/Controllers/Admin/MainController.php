<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use  App\Http\Controllers\Admin;
use App\Models\Admin as ModelsAdmin;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    
    function index(){   
        $orders = order::orderBy('created_at' ,'desc')->take(7)->get();  
        $count_order = Order::count();  
        $total_price = Order::sum('total_price');
        $count_customer = Customer::count();
        $comments = Blog::count();
        $userName = session('user_name'); 
        return view('admin.home',[
            'title' => 'Trang Quản Trị Admin',
            'total_price' => $total_price,
            'count_order' => $count_order,
            'count_customer' => $count_customer,
            'comments' => $comments,
            'orders' => $orders,
            
        ]);
    }
    function contact(){   
        $contact = Contact::orderBy('id','asc')->get();   
        $count_order = Order::count();  
        $total_price = Order::sum('total_price');
        $count_customer = Customer::count();
        $comments = Blog::count();
        $userName = session('user_name'); 
        return view('admin.contact.list',[
            'title' => 'Trang Contact ',
            'total_price' => $total_price,
            'count_order' => $count_order,
            'count_customer' => $count_customer,
            'comments' => $comments,
            'contacts' => $contact,
            
        ]);
    }
}
