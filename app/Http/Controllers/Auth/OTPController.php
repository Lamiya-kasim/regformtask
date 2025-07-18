<?php

namespace App\Http\Controllers\Auth;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SendOtpMail;

class OTPController extends Controller
{
    // Show email form
    public function showEmailForm()
    {
        return view('login-email'); // form to enter email
    }

    // Send OTP to email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            'location' => 'required|string',
            'department' => 'required|string',
        ]);

        $otp = rand(100000, 999999);

        // Store details in session
        session([
            'otp' => $otp,
            'email' => $request->email,
            'username' => $request->username,
            'location' => $request->location,
            'department' => $request->department,
        ]);

        // Send OTP to email
        Mail::to($request->email)->send(new SendOtpMail($otp));

        return redirect()->route('verify.otp.page')->with('message', 'OTP sent to your email!');
    }

    // Show verify OTP form
    public function showVerifyForm()
    {
        return view('verify-otp'); // form to enter OTP
    }

    // Verify entered OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        if ($request->otp == session('otp')) {
            // Save user data to database
            $user = User::create([
                'name' => session('username'),
                'email' => session('email'),
                'password' => bcrypt('default_password'), // Set a default password
                'location' => session('location'),
                'department' => session('department'),
            ]);

           \Illuminate\Support\Facades\Auth::login($user);



            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Invalid OTP');
    }
}
