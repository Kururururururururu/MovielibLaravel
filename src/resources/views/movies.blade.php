<!doctype html>
<html lang="da">
    <head>
        <meta charset="UTF-8">
        <title>Movies</title>
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta property="og:title" content="Popular Movies">
        <meta property="og:description" content="Popular Movies">
        <link href="{{ asset('css/css-reset.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/movies.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('comps.main.header')
        @include('comps.main.menu')

        <section class="movie-list">
            @foreach ($movies-> results as $movie)
                <a class="movie-link" href="{{"/movie?id=" . $movie->id}}">
                    <div class="movie-card">
                        <img class="movie-image" src="{{
                        @getimagesize("https://image.tmdb.org/t/p/w200/" . $movie->poster_path) ?
                        "https://image.tmdb.org/t/p/w200/" . $movie->poster_path :
                        asset('icons/movie_fallback_image.jpg')
                        }}">
                        <h2 class="movie-text">{{ $movie->title }}</h2>
                        <!-- Make either star or text based rating display here. 
                        Use own database instead of tmdb data. -->
                        <p class="movie-rating">{{$movie->vote_average}}</p>
                        <p class="movie-release">{{$movie->release_date}}</p>
                    </div>
                    <div class="page-select">
                        
                    </div>
                </a>
            @endforeach
        </section>
    </body>
</html>