<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Styles -->
    <link href="{{ asset('css/css-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @viteReactRefresh
    @vite(['public/js/app.jsx', 'public/css/app.css', 'public/js/pages/login.jsx'])
    <script>
        const loginRoute = @json(route('login'));
        // Now you can use the loginRoute variable in your JavaScript code
        console.log(loginRoute);
    </script>
</head>

<body>
    <header>
        <!-- Header imported from ./comps/main/header.blade.php -->
        @include('comps.main.header')
    </header>
    <div id="login"></div>
</body>

</html>
