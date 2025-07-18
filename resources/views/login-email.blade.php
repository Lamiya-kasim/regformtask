<!DOCTYPE html>
<html>
<head>
    <title>Registration page task</title>
    <style>
        body {
            background-color: #f0f4f8;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .login-box input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .login-box button {
            width: 100%;
            padding: 10px;
            background-color: #1d72b8;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .login-box button:hover {
            background-color: #155a96;
        }

        .message {
            color: green;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Registration page Task</h2>

        @if(session('message'))
            <p class="message">{{ session('message') }}</p>
        @endif

        <form action="{{ route('send.otp') }}" method="POST">
            @csrf
           <input type="text" name="username" placeholder="Enter your name" required>
<input type="email" name="email" placeholder="Enter your email" required>
<input type="text" name="location" placeholder="Enter your location" required>
<input type="text" name="department" placeholder="Enter your department" required>

          <button type="submit">Register</button>

        </form>
    </div>
</body>
</html>
