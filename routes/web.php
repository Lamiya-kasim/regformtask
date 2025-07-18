<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\OTPController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login-email', [OTPController::class, 'showEmailForm'])->name('login.email');
Route::post('/send-otp', [OTPController::class, 'sendOtp'])->name('send.otp');
use Illuminate\Support\Facades\Mail;

Route::get('/test-mail', function () {
    Mail::raw('This is a test email from Lamy\'s Laravel app.', function ($message) {
        $message->to('inayalazim9@gmail.com')
                ->subject('Test Email from Laravel');
    });

    return '✅ Test email sent! Check your inbox.';
});


Route::get('/verify-otp', [OTPController::class, 'showVerifyForm'])->name('verify.form');
Route::post('/verify-otp', [OTPController::class, 'verifyOTP'])->name('verify.otp');

Route::get('/dashboard', function () {
    return "You are logged in!";
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
use Illuminate\Support\Facades\Session;

Route::post('/logout', function () {
    Session::flush();
    return redirect('/login')->with('success', 'Logged out successfully.');
});

Route::get('/verify-otp', [OTPController::class, 'showVerifyForm'])->name('verify.otp.page');

Route::get('/logout', function () {
    session()->flush(); // Clears the session
    return redirect()->route('login.email')->with('message', 'Logged out successfully!');
})->name('logout');