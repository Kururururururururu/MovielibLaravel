<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- Styles -->
    <link href="{{ asset('css/css-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Javascript -->
    <script src="{{ asset('js/login.js') }}"></script>
</head>

<body>
    <!-- Header imported from ./comps/main/header.blade.php -->
    @include('comps.main.header')
    <main>
        <form method="POST" action="{{ route('login') }}" class="loginform">
            @csrf
            <h1>Login</h1>
            <pre>
                
            </pre>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" id="loginbutton" value="Login">
            <input type="submit" id="registerbutton" value="Register">
        </form>
    </main>
</body>

</html>
