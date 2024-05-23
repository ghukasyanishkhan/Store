@php use Illuminate\Support\Facades\Auth; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/app.css">
</head>
<body>
@include('message')
<div class="register-container">
    <h2>Register</h2>
    <form action="{{ route('registration') }}" method="post">
@csrf
        <label>
            <input type="text" name="first_name" placeholder="First Name" required>
        </label>
        <label>
            <input type="text" name="last_name" placeholder="Last Name" required>
        </label>
        <label>
            <input type="tel" name="phone" placeholder="Phone" required>
        </label>
        <label>
            <input type="email" name="email" placeholder="Email" required>
        </label>
        <label>
            <input type="password" name="password" placeholder="Password" required>
        </label>
        <input type="submit" value="Register">
    </form>
</div>
</body>
</html>
