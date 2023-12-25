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
    <main>
        <div class="create">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="container">
                    <h1>Movie Rater</h1>
                    <pre>
                </pre>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="First and last name" required><br>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="Username" required><br>
                    @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email"required><br>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required><br>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="password_confirmation">Confirm password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required><br>
                </div>
                <input type="submit" value="Create Movie Rater account" id="registerButton">
                <div class="Alreadycreated">
                    <label for="Accountexist">Already have an account?</label>
                    <a class="link" id="signinButton">Sign in</a>
                </div>
        </div>
        </form>
    </main>

</body>

</html>
