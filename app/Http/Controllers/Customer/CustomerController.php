<?php 

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CreateFormRequest;
use App\Http\Service\Cart\CartService;
use App\Models\Customer; 
use App\Http\Service\Customer\CustomerService; 
use App\Http\Service\Menu\MenuService;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    protected $customerService;
    protected $menuService;
    protected $cartService;


    public function __construct(CustomerService $customerService,MenuService $menuService,CartService $cartService) {
        $this->customerService = $customerService; 
        $this->menuService = $menuService; 
        $this->cartService = $cartService; 
    }



    public function login()
    {
        $customerID = session('customerID');
        $count_cart = Cart::where('customer_id',$customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');
       
        return view('pages.login', [
            'title' => 'login',  
            'carts' => $this->cartService->getAll(),
            'menus' => $this->menuService->getParent(), 
            'count' => 3,
            'total' => $total,
            'count_cart' => $count_cart,
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
                $customerID = Auth::guard('cus')->user()->id;
                $countWishlist = $this->customerService->countWishlistById($customerID);
                

                // Lưu tên khách hàng vào session để hiển thị trên header
                session(['countWishlist' => $countWishlist]);       
                session(['customerName' => $customerName]);
                session(['customerID' => $customerID]);

                
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
