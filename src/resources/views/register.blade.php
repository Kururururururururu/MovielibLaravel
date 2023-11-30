<!DOCTYPE html>
<html>

<head>
    <!DOCTYPE html>
    <html>

    <head>
        <!-- Styles -->
        <link href="{{ asset('css/css-reset.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/register.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @viteReactRefresh
        @vite(['public/js/app.jsx', 'public/css/app.css', 'public/js/pages/register.jsx'])
        <script>
            const registerRoute = @json(route('register'));
            const loginRoute = @json(route('login'));
            // Now you can use the registerRoute variable in your JavaScript code
            console.log(registerRoute);
        </script>

    </head>

<body>
    <!-- Header imported from ./comps/main/header.blade.php -->
    @include('comps.main.header')
    <div id="register"></div>
</body>

</html>
