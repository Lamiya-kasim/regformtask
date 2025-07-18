<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
</head>
<body>
    <h1>Enter OTP</h1>

    @if(session('error'))
        <p style="color: red">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('verify.otp') }}">
        @csrf
        <input type="hidden" name="email" value="{{ session('email') }}">
        
        <label for="otp">OTP:</label>
        <input type="text" name="otp" required>
        <br><br>
        <button type="submit">Verify OTP</button>
    </form>
</body>
</html>
