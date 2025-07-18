<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
        body {
            background-color: #e7f0fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial;
        }

        .dashboard-box {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        p {
            margin: 10px 0;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="dashboard-box">
        <h2>Welcome, {{ session('username') }}</h2>
        <p><strong>Email:</strong> {{ session('email') }}</p>
        <p><strong>Location:</strong> {{ session('location') }}</p>
        <p><strong>Department:</strong> {{ session('department') }}</p>

        <div style="text-align: right; margin: 20px;">
    <a href="{{ route('logout') }}" 
       style="background-color: #dc3545; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none;">
       Logout
    </a>
</div>

    </div>
</body>
</html>

