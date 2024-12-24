<?php

namespace App\Http\Service\Address;

use App\Models\Address;
use App\Models\Blog;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Wishlist;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class AddressService
{


    public function create($request)
    {
        try {
            Log::info('Request data:', $request->all());
            $customerID = session('customerID');
   

            Address::create([
                'customer_id' => $customerID,
                'name' => (string) $request->input('name'),
                'phone' => (string) $request->input('phone'),
                'address' => (string) $request->input('address'),
                'address_detail' =>(string) $request->input('address_detail'),
            ]);

            Session::flash('success', 'Bình Luận Thành Công');
        } catch (\Exception $err) {
            Log::error('Registration error: ' . $err->getMessage()); // Ghi log lỗi
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
}
