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
    @include('comps.main.header')

    <!--
    PLAN:
    - get user id
    - get movie id's related to user id form the database
    - get details about the movies from the API
    - show movies
    -->

    <!-- Main section -->
    <section class="movie-list">
        @foreach ($wl_movies as $movie)
            <a class="movie-link" href="{{ '/movie?id=' . $movie->id }}">
                <div class="movie-card">
                    <img class="movie-image"
                        src="{{ @getimagesize('https://image.tmdb.org/t/p/w200/' . $movie->poster_path)
                            ? 'https://image.tmdb.org/t/p/w200/' . $movie->poster_path
                            : asset('icons/movie_fallback_image.jpg') }}">
                    <h2 class="movie-text">{{ $movie->title }}</h2>
                    <!-- Make either star or text based rating display here.
                        Use own database instead of tmdb data. -->
                    <p class="movie-rating">{{ $movie->vote_average }}</p>
                    <p class="movie-release">{{ $movie->release_date }}</p>
                </div>
                <div class="page-select">

                </div>
            </a>
        @endforeach
    </section>

    <!-- Footer -->
    @include('comps.main.footer')
</body>
