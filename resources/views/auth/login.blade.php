<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/app.css">
</head>
<body>
@include('message')
<div class="login-container">
    <h2>Login</h2>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <label>
            <input type="text" name="email" placeholder="Username" required>
        </label>
        <label>
            <input type="password" name="password" placeholder="Password" required>
        </label>
        <input type="submit" value="Login">
    </form>
</div>
</body>
</html>
