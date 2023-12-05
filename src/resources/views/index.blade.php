<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Movie Rater</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/css-reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        @include('comps.main.header')
    </header>
    <!-- Header imported from ./comps/main/header.blade.php -->

    <nav class="navbar"></nav>
    <!-- Main Body Start -->
    <section class="welcome">
        <h1>Movie Rater</h1>
        <p>The Ultimate Film Appreciator</p>
    </section>

    <section class="featured-movies">
        <h1>Popular movies:</h1>
        <div class="top5">
            @foreach ($movies->results as $index => $movie)
            @if ($index < 5)
            <a class="featured" href="{{ "/movie?id=" . $movie->id }}">
                <img class="movie-img" src="{{ @getimagesize("https://image.tmdb.org/t/p/w200/" . $movie->poster_path) ?
                        "https://image.tmdb.org/t/p/w200/" . $movie->poster_path :
                        asset('icons/movie_fallback_image.jpg')
                    }}">
                <div class="featured-textbox">
                    <p class="movie-title">{{ $movie->title }}</p>
                    <p class="rating">{{ $movie->vote_average }}</p>
                </div>
            </a>
            @endif
            @endforeach
        </div>
    </section>

    <!-- Main Body End -->
    <!-- Footer imported from ./comps/main/footer.blade.php -->
    @include('comps.main.footer')
</body>

</html>