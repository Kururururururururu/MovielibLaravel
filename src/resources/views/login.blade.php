<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- Styles -->
    <link href="{{ asset('css/css-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

</head>

<body>
     <!-- Header imported from ./comps/main/header.blade.php -->
     @include('comps.main.header')
    <div calss="container">
        <h1>Login</h1>
    </div>
    <form action="/login">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="register" value="Register">
        <input type="submit" value="Login">
    
    

    </form>
</body>
</html>