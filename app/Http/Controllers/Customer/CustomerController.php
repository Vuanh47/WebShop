<?php 

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CreateFormRequest;
use App\Models\Customer; // Thêm import cho Customer model
use App\Http\Service\Customer\CustomerService; // Sửa lại import
use App\Http\Service\Menu\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    protected $customerService;
    protected $menuService;


    public function __construct(CustomerService $customerService,MenuService $menuService) {
        $this->customerService = $customerService; 
        $this->menuService = $menuService; 
    }



    public function login()
    {
        return view('pages.login', [
            'title' => 'login',  
            'menus' => $this->menuService->getParent(), 
            'count' => 3,
        ]);
    }

    public function register(CreateFormRequest $request) {
        $result = $this->customerService->create($request);
    
        if ($result) {
            return redirect('/')->with('success', 'Registration successful! You are now logged in.');
        }

            return back()->withErrors(['register' => 'Registration failed. Please try again.']);
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'required|email:filter',
            'password' => 'required|string|min:6', 
        ]);

        if(Auth::guard('cus')->attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')])){

                 $customerName = Auth::guard('cus')->user()->name;
                    // Lưu tên khách hàng vào session để hiển thị trên header
                 session(['customerName' => $customerName]);
        return redirect()->route('index');
        }

        return redirect()->back()->withErrors(['login' => 'Login failed.']);

    }

    public function logout(Request $request)
    {
        // Thực hiện logout
        Auth::guard('cus')->logout();

        // Xóa thông tin phiên
        $request->session()->invalidate();

        // Tạo lại phiên
        $request->session()->regenerateToken();

        return redirect()->route('index')->with('success', 'You have been logged out successfully.');
    }

}
