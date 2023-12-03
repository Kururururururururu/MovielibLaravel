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
    <section class="Profile-card">
        this is the profile page
    </section>

    <!-- Footer -->
    <footer>
        @include('comps.main.footer')
    </footer>

</body>

</html>
