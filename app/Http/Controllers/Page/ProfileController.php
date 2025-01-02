<?php

namespace App\Http\Controllers\Page;

use App\Http\Service\Address\AddressService as AddressAddressService;
use App\Http\Service\Blog\AddressService;
use App\Http\Service\Cart\CartService;
use App\Http\Service\Customer\CustomerService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\OrderDetail\OrderDetailService;
use App\Http\Service\Product\ProductService;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController
{
    protected $menuService;
    protected $productService;
    protected $customerService;
    protected $cartService;

    protected $orderDetailService;

    protected $addressService;

    public function __construct(MenuService $menuService, ProductService $productService, CustomerService $customerService, CartService $cartService, OrderDetailService $orderDetailService, AddressAddressService $addressService)
    {
        $this->menuService = $menuService;
        $this->productService = $productService;
        $this->customerService = $customerService;
        $this->cartService = $cartService;
        $this->orderDetailService = $orderDetailService;
        $this->addressService = $addressService;
    }
    public function profile()
    {

        $customerID = session('customerID');
        $orders = $this->orderDetailService->getAll();
        $customer = Customer::find($customerID);
        $customerID = session('customerID');
        $count = Wishlist::where('customer_id', $customerID)->count();
        $count_cart = Cart::where('customer_id', $customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');

        return view('pages.profile.profile_detail', [
            'title' => 'Profile',
            'menus' => $this->menuService->getParent(),
            'carts' => $this->cartService->getAll(),
            'orders' => $orders,
            'customer' => $customer,
            'count' => $count,
            'total' => $total,
            'count_cart' => $count_cart,
        ]);
    }

    public function address()
    {

        $customerID = session('customerID');
        $orders = $this->orderDetailService->getAll();
        $customer = Customer::find($customerID);
        $customerID = session('customerID');
        $address = Address::where('customer_id', $customerID)->get();
        $count = Wishlist::where('customer_id', $customerID)->count();
        $count_cart = Cart::where('customer_id', $customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');

        return view('pages.profile.address', [
            'title' => 'Address',
            'menus' => $this->menuService->getParent(),
            'carts' => $this->cartService->getAll(),
            'orders' => $orders,
            'customer' => $customer,
            'addresses' => $address,
            'count' => $count,
            'total' => $total,
            'count_cart' => $count_cart,
        ]);
    }

    public function changePassword()
    {

        $customerID = session('customerID');
        $orders = $this->orderDetailService->getAll();
        $customer = Customer::find($customerID);
        $customerID = session('customerID');
        $address = Address::where('customer_id', $customerID)->get();
        $count = Wishlist::where('customer_id', $customerID)->count();
        $count_cart = Cart::where('customer_id', $customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');


        return view('pages.profile.change_password', [
            'title' => 'Change Password',
            'menus' => $this->menuService->getParent(),
            'carts' => $this->cartService->getAll(),
            'orders' => $orders,
            'customer' => $customer,
            'addresses' => $address,
            'count' => $count,
            'total' => $total,
            'count_cart' => $count_cart,
        ]);
    }

    public function order()
    {

        $customerID = session('customerID');


        $customer = Customer::find($customerID);
        $orders = $this->orderDetailService->get4();
        $customerID = session('customerID');
        $address = Address::where('customer_id', $customerID)->get();
        $count = Wishlist::where('customer_id', $customerID)->count();
        $count_cart = Cart::where('customer_id', $customerID)->count();
        $total = Cart::where('customer_id', $customerID)->sum('total');

        return view('pages.profile.my_order', [
            'title' => 'My Order',
            'menus' => $this->menuService->getParent(),
            'carts' => $this->cartService->getAll(),
            'orders' => $orders,
            'customer' => $customer,
            'addresses' => $address,
            'count' => $count,
            'total' => $total,
            'count_cart' => $count_cart,
        ]);
    }

    public function createAddress(Request $request)
    {
        $result = $this->addressService->create($request);

        return redirect()->back();
    }

    public function update(Request $request)
    {
        try {
            $address = Address::find($request->id);
            $address->name = $request->name;
            $address->phone = $request->phone;
            $address->address = $request->address;
            $address->address_detail = $request->address_detail;
            $address->save();

            return redirect()->back()->with('success', 'Cập nhật địa chỉ thành công');
        } catch (\Exception $e) {
            Log::error('Error updating address', [
                'error' => $e->getMessage(),
                'address_id' => $request->id
            ]);
            return redirect()->back()->with('error', 'Có lỗi khi cập nhật địa chỉ');
        }
    }



    public function updatePassword(Request $request)
    {
        $customerID = session('customerID');
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);
        $customer = Customer::find($customerID);

        if (!Hash::check($request->current_password, $customer->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        if ($customer) {
            $customer->password = Hash::make($request->new_password);
            $customer->save();
        }


        return back()->with('success', 'Password updated successfully.');
    }

    public function updateProfile(Request $request)
    {

        try {
            $customerID = session('customerID');
            $customer = Customer::find($customerID);
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->avatar = $request->thumb;
            $customer->email = $request->email;
            $customer->save();

            return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
        } catch (\Exception $e) {
            Log::error('Error updating address', [
                'error' => $e->getMessage(),
                'address_id' => $request->id
            ]);
            return redirect()->back()->with('error', 'Có lỗi khi cập nhật địa chỉ');
        }
    }
}
