<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CreateFormRequest;
use App\Http\Service\Cart\CartService;
use App\Models\Customer;
use App\Http\Service\Customer\CustomerService;
use App\Http\Service\Menu\MenuService;
use App\Mail\RegisterCusomerMail;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    protected $customerService;
    protected $menuService;
    protected $cartService;

    public function __construct(CustomerService $customerService, MenuService $menuService, CartService $cartService)
    {
        $this->customerService = $customerService;
        $this->menuService = $menuService;
        $this->cartService = $cartService;
    }

    public function login()
    {
        try {
            $customerID = session('customerID');
            $count_cart = Cart::where('customer_id', $customerID)->count();
            $total = Cart::where('customer_id', $customerID)->sum('total');

            Log::info('User accessed login page', ['customerID' => $customerID]);

            return view('pages.login', [
                'title' => 'login',
                'carts' => $this->cartService->getAll(),
                'menus' => $this->menuService->getParent(),
                'count' => 0,
                'total' => $total,
                'count_cart' => $count_cart,
            ]);
        } catch (\Exception $e) {
            Log::error('Error while loading login page: ' . $e->getMessage());
            return redirect()->route('index')->withErrors(['error' => 'Failed to load login page.']);
        }
    }

    public function register(CreateFormRequest $request)
    {
        try {
            $result = $this->customerService->create($request);

            if ($result) {
                try {
                    Mail::to($request->email)->send(new RegisterCusomerMail($result));
                    Log::info('Registration email sent successfully', ['email' => $request->email]);
                } catch (\Exception $e) {
                    Log::error('Failed to send registration email: ' . $e->getMessage());
                    return redirect('/')->with('warning', 'Registration successful, but email notification failed.');
                }

                Log::info('Customer registered successfully', ['email' => $request->email]);
                return redirect()->route('login')->with('success', 'Registration successful! You are now logged in.');
            }
        } catch (\Exception $e) {
            Log::error('Customer registration failed: ' . $e->getMessage());
        }

        return back()->withErrors(['register' => 'Registration failed. Please try again.']);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email:filter',
                'password' => 'required|string|min:6',
            ]);

            if (Auth::guard('cus')->attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ])) {
                $customer = Auth::guard('cus')->user();
                $customerName = $customer->name;
                $customerMail = $customer->email;
                $customerID = $customer->id;
                $countWishlist = $this->customerService->countWishlistById($customerID);

                session(['countWishlist' => $countWishlist]);
                session(['customerName' => $customerName]);
                session(['customerID' => $customerID]);
                session(['customerMail' => $customerMail]);

                Log::info('User logged in successfully', ['customerID' => $customerID, 'email' => $customerMail]);

                return redirect()->route('index');
            }

            Log::warning('Login failed for user', ['email' => $request->input('email')]);
            return redirect()->back()->withErrors(['login' => 'Login failed.']);
        } catch (\Exception $e) {
            Log::error('Error during login process: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred. Please try again.']);
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::guard('cus')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            Log::info('User logged out successfully');
            return redirect()->route('index')->with('success', 'You have been logged out successfully.');
        } catch (\Exception $e) {
            Log::error('Error during logout process: ' . $e->getMessage());
            return redirect()->route('index')->withErrors(['error' => 'Logout failed.']);
        }
    }

    public function forgetpassword()
    {
        try {
            $customerID = session('customerID');
            $count_cart = Cart::where('customer_id', $customerID)->count();
            $total = Cart::where('customer_id', $customerID)->sum('total');

            Log::info('User accessed login page', ['customerID' => $customerID]);

            return view('pages.forgetpassword.index', [
                'title' => 'login',
                'carts' => $this->cartService->getAll(),
                'menus' => $this->menuService->getParent(),
                'count' => 0,
                'total' => $total,
                'count_cart' => $count_cart,
            ]);
        } catch (\Exception $e) {
            Log::error('Error while loading login page: ' . $e->getMessage());
            return redirect()->route('index')->withErrors(['error' => 'Failed to load login page.']);
        }
    }
    public function changePassword($email)
    {
        $customerID = session('customerID');
        $count_cart = Cart::where('customer_id', $customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');
        $username = Customer::where('email', $email)->value('name');
        return view('pages.forgetpassword.change-password', [
            'title' => 'login',
            'carts' => $this->cartService->getAll(),
            'menus' => $this->menuService->getParent(),
            'count' => 0,
            'total' => $total,
            'count_cart' => $count_cart,
            'email' => $email,
            'name' => $username,
        ]);
    }

    public function confirmPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6',
        ]);

        $username = $request->input('name');
        $new_password = Hash::make($request->input('password'));
        Customer::where('name', $username)->update(['password' => $new_password]);

        return redirect()->route('login')->with('success', 'Password updated successfully!');
    }
}
