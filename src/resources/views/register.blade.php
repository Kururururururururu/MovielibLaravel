<!DOCTYPE html>
<html>
<head>
    <!-- Styles -->
    <link href="{{ asset('css/css-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
</head>

<body>
     <!-- Header imported from ./comps/main/header.blade.php -->
     @include('comps.main.header')
    <div class="container">
        <h1>Register</h1>
    </div>
    <form action="/register">
        <div class="form-group">
            <label for="first_name">First name:</label>
            <input type="text" id="First name" name="First name" required><br>
        </div>
        <div action="form-group">
        <label for="last_name">Last name:</label>
        <input type="text" id="Last name" name="Last name" required><br>
        </div>
        <input type="register" value="Register">
        <input type="submit" value="Login">
    </form>
    
</body>
</html>