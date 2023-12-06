<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title -->
    <title>Profile</title>

    <!-- Styles -->
    <link href="{{ asset('css/css-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">

    <!-- Javascript -->
    <script src="{{ asset('js/profile.js') }}"></script>

</head>

<body>
    <!-- Header imported from ./comps/main/header.blade.php -->
    <header>
        @include('comps.main.header')
    </header>

    <!-- Main -->
    <main class="Profile-card">
        <h1 class="page-header">PROFILE</h1>
        <ul>
            <li>
                <label>Name:</label>
                <p>{{$my_info->name}}</p>
            </li>
            <li>
                <label>Username:</label>
                <p>{{$my_info->username}}</p>
            </li>
            <li>
                <label>Email:</label>
                <p>{{$my_info->email}}</p>
            </li>
            <li>
                <label>Registration Date:</label>
                <p>{{$my_info->created_at}}</p>
            </li>
            <li>
                <label>Rights:</label>
                <span class="rights">Can comment</span> <!-- or use class="no-rights" for red color -->
            </li>
        </ul>
    </main>

    <!-- Footer -->
    <footer>
        @include('comps.main.footer')
    </footer>

</body>

</html>
