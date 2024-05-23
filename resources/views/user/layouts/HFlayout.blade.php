<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/user.css">
</head>
<body>
@include('message')
<header>
         @include('user.components.header')
</header>
<div class="main">
    @yield('content')
</div>

<footer>
    @include('user.components.footer')</footer>
</body>
</html>
