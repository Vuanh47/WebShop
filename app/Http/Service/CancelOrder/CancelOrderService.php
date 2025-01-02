<?php

namespace App\Http\Service\CancelOrder;

use App\Models\Address;
use App\Models\Blog;
use App\Models\cancelOrder as ModelsCancelOrder;
use App\Models\CancelOrder as AppModelsCancelOrder;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Wishlist;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class CancelOrderService
{


    public function create($request)
    {
        try {
            Log::info('Request data:', $request->all());
            $customerID = session('customerID');


            AppModelsCancelOrder::create([
                'order_id' => (string) $request->input('order_id'),
                'cancel_reason' => (string) $request->input('cancel_reason'),
                'other_cancel_reason' => (string) $request->input('other_cancel_reason'),
                'status' => 'pending',
            ]);

            Session::flash('success', 'Gửi yêu cầucầu Thành Công');
        } catch (\Exception $err) {
            Log::error('Registration error: ' . $err->getMessage()); // Ghi log lỗi
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
}
