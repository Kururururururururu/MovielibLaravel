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
        <div class="fixer"><p> </p></div>
        @include('comps.main.header')
        @include('comps.main.menu')

        <section class="movie-list">
            @foreach ($movies-> results as $movie)
                <div class="movie-card">
                    <h2>{{ $movie->title }}</h2>
                </div>
            @endforeach
        </section>
    </body>
</html>
