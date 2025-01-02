<?php 

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Mail\RegisterAdminMail;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller{

    public function register(Request $request) {
        $request->validate([
            'email' => 'required|email:filter|unique:admin,email', 
            'password' => 'required|string|min:6', 
            'name' => 'required|string|max:255',
        ]);

        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
        ]);
         // Gửi email thông báo đăng ký thành công
      Mail::to($request->email)->send(new RegisterAdminMail($user)); 
      
        Auth::login($user);
        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
        ]);
        return redirect()->route('admin')->with('success', 'Registration successful! You are now logged in.');
    }
}
