<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .welcome-container {
            text-align: center;
        }
        .welcome-container h1 {
            margin-top: 0;
        }
        .welcome-container a {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .welcome-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="welcome-container">
    <h1>Welcome!</h1>
    <a href="{{ route('registration-page') }}">Register</a>
    <a href="{{ route('login-page') }}">Login</a>
</div>
</body>
</html>
