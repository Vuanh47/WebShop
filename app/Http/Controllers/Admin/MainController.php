<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use  App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    
    function index(){        
        return view('admin.home',[
            'title' => 'Trang Quản Trị Admin'
        ]);
    }
}
