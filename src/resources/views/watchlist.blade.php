<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title -->
    <title>Watchlist</title>

    <!-- Styles -->
    <link href="{{ asset('css/css-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/watchlist.css') }}" rel="stylesheet">

    <!-- Javascript -->
    <script src="{{ asset('js/watchlist.js') }}"></script>

</head>

<body>
    <!-- Header imported from ./comps/main/header.blade.php -->
    <header>
        @include('comps.main.header')
    </header>
    
    <!-- Main section -->
    <section class="movie-list">
        <h1>Hello there!</h1>
    </section>


    <!--
    PLAN:
    - get user id
    - get movie id's related to user id form the database
    - get details about the movies from the API
    - show movies
    -->
    
</body>