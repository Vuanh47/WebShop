<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {       
        return view('admin.users.login', ['title' => 'Đăng Nhập']);
    }
    
    public function store(Request $request){
        $request->validate([
            'email' => 'required|email:filter',
            'password' => 'required|string|min:6', 
        ]);

        if(Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')])){

            return redirect()->route('admin');
        }

        return redirect()->back()->withErrors(['login' => 'Login failed.']);

    }


}
