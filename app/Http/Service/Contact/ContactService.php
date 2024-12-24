<?php
namespace App\Http\Service\Contact;

use App\Models\Blog;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Wishlist;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class ContactService{


    public function create($request){    
        try {
   
            Log::info('Request data:', $request->all());
            $customerID = session('customerID');
    
            // Tạo tài khoản mới
            Contact::create([
                'customer_id' => $customerID,
                'subject' => (string) $request->input('subject'),
                'message' => (string) $request->input('message'),
               
            ]);
    
            Session::flash('success', 'Contact Thành Công');
        } catch (\Exception $err) {
          
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    

}