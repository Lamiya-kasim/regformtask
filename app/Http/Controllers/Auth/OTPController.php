<?php

namespace App\Http\Controllers\Auth;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
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

    // Send OTP to email and store (with old deletion)
    public function sendOtp(Request $request)
    {
        $request->validate([
            'username'   => 'required|string',
            'email'      => 'required|email',
            'location'   => 'required|string',
            'department' => 'required|string',
        ]);

        $email = $request->email;

        // Delete previous OTPs for this email (good practice)
        Otp::where('email', $email)->delete();

        // Generate new OTP
        $otp = rand(100000, 999999);

        // Store OTP in otps table
        Otp::create([
            'email'      => $email,
            'otp'        => $otp,
            'created_at' => now(),
        ]);

        // Store user details in session (not the OTP now, just user info for registration after OTP verification)
        session([
            'username'   => $request->username,
            'email'      => $request->email,
            'location'   => $request->location,
            'department' => $request->department,
        ]);

        // Send OTP to email
        Mail::to($email)->send(new SendOtpMail($otp));

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

        $email = session('email');
        $enteredOtp = $request->otp;

        // Find latest valid OTP for this email (can add expiry check here)
        $otpRecord = Otp::where('email', $email)
            ->where('otp', $enteredOtp)
            ->first();

        if ($otpRecord) {
            // OTP matched! Delete it for security
            $otpRecord->delete();

            // Save user data to database (prevent duplicate accounts)
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name'       => session('username'),
                    'password'   => bcrypt('default_password'), // consider random or null in real projects
                    'location'   => session('location'),
                    'department' => session('department'),
                ]
            );

            Auth::login($user);

            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Invalid OTP');
    }
}
