<!DOCTYPE html>
<html>
<head>
    <!-- Styles -->
    <link href="{{ asset('css/css-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">

    <!-- Javascript -->
    <script src="{{ asset('js/register.js') }}"></script>
</head>

<body>
     <!-- Header imported from ./comps/main/header.blade.php -->
     @include('comps.main.header')
    <div class="container">
        <h1>Movie Rater</h1>
    </div>
    <form action="/register">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="username" name="username" placeholder="First and last name" required><br>
            <label for="email">Email:</label>
            <input type="email" id="Email" name="Email"required><br>
            <label for="password">Password:</label>
            <input type="password" id="Password" name="Password" required><br>
            <label for="password_confirmation">Confirm password:</label>
            <input type="password" id="Password confirmation" name="Password confirmation" required><br>
        </div>
        <input type="submit" value="Create Movie Rater account">
        <div class="Alreadycreated">
        <label for="Accountexist">Already have an account?</label>
        <button class="link" id="signinButton">Sign in</button>
        </div>
    </form>
    
</body>
</html>