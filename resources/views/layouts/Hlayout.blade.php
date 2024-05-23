<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/app.css">
</head>
<body>
@include('message')

<div class="header">
    @include('admin.components.header')
</div>

<div class="maim">
    @yield('content')
</div>
<footer>

</footer>
</body>
</html>
