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
        <h1>Movie Rater</h1>
    </div>
    <form action="/register">
        <label for="name">Name:</label>
        <div class="form-group">
            <input type="text" id="First name" name="First name" placeholder="First name" required><br>
            <input type="text" id="Last name" name="Last name" placeholder="Last name" required><br>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="Email" name="Email" required><br>
            <label for="password">Password:</label>
            <input type="password" id="Password" name="Password" required><br>
            <label for="password_confirmation">Confirm password:</label>
            <input type="password" id="Password confirmation" name="Password confirmation" required><br>
        </div>
        <input type="register" value="Create Movie Rater account">
    </form>
    
</body>
</html>