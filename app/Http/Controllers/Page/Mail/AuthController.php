<?php
namespace App\Http\Controllers\Page\Mail;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\While_;

class AuthController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        $emailExists = Customer::where('email',$email)->exists();
        if(!$emailExists){
            return response()->json()->withErrors(['error' => 'Email not Found!']);
        }
        $otp = rand(100000, 999999);

        // Lưu OTP vào session (hoặc database)
        Session::put('otp', $otp);
        Session::put('otp_expires_at', now()->addMinutes(5)); // OTP hết hạn sau 5 phút

        // Gửi email
        Mail::raw("Your OTP is: $otp", function ($message) use ($email) {
            $message->to($email)
                ->subject('Your OTP Code');
        });

        return response()->json(['message' => 'OTP sent successfully!']);
    }

    public function verifyOtp(Request $request){
        $request ->validate([
            'otp' => 'required|numeric',
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        $userOtp = $request->input('otp');
        $storeOtp = Session::get('otp');
        $expireAt = Session::get('otp_expires_at');

        if(!$expireAt || !$storeOtp){
            return redirect()->back()->withErrors(['error' => 'OTP is invalid or expired']);
        }

        if(now()->greaterThan($expireAt)){
            Session::forget(['otp', 'otp_expires_at']);
            return redirect()->back()->withErrors(['error' => 'OTP has expired']);
        }

        if($userOtp == $storeOtp){
            Session::forget(['otp', 'otp_expires_at']);
              return redirect()->route('changePassword',$email);
        }else {
            return redirect()->back()->withErrors(['error' => 'Incorrect OTP']);
        }
    }

   
}
