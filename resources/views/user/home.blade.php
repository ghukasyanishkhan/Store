<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/user.css">
    <title>Home</title>
</head>
<body>
@include('message')
<header>
@include('user.components.header')
</header>
<nav>
    @include('user.components.navbar')
</nav>
<main>

    @if(isset($items))
        @foreach($items as $item)
            @include('user.components.home-item')
        @endforeach
    @endif


</main>
<footer>
    @include('user.components.footer')
</footer>

</body>
</html>
