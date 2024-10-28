<?php 

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class RegisterController extends Controller{

    public function register(Request $request) {
        // Validate the request data
        $request->validate([
            'email' => 'required|email:filter|unique:admin,email', // Ensure email is unique
            'password' => 'required|string|min:6', 
            'name' => 'required|string|max:255',
        ]);

        // Create the new user in the database
        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
        ]);

        // Automatically log the user in after registration
        Auth::login($user);

        return redirect()->route('admin')->with('success', 'Registration successful! You are now logged in.');
    }
}
