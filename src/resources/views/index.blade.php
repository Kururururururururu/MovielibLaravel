<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Movie Rater</title>
    <!-- Styles -->
    <link href="{{ asset('css/css-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
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
    
    <div class="navbar"></div>
    <!-- Main Body Start -->
    <div class="welcome">
        <h1>Movie Rater</h1>
        <p>The Ultimate Film Appreciator</p>
    </div>
    
    <div class="featured-movies">
        <h1>Popular movies:</h1>
        <div class="top5">
        @foreach ($movies->results as $index => $movie)
            @if ($index < 5)
                <a class="featured" href="{{ "/movie?id=" . $movie->id }}">
                    <img class="movie-img" src="{{
                        @getimagesize("https://image.tmdb.org/t/p/w200/" . $movie->poster_path) ?
                        "https://image.tmdb.org/t/p/w200/" . $movie->poster_path :
                        asset('icons/movie_fallback_image.jpg')
                    }}">
                    <p class="movie-title">{{ $movie->title }}</p>
                    <p class="rating">{{ $movie->vote_average }}</p>
                </a>
            @endif
        @endforeach
            <!--
            <a class="featured" href="#1">
                <img class="movie-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png?20200912122019">
                <p class="movie-title">title1</p>
                <p class="rating"> 4</p>
            </a>
            <a class="featured" href="#2">
                <img class="movie-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png?20200912122019">
                <p class="movie-title">title2</p>
                <p class="rating"> 3</p>
            </a>
            <a class="featured" href="#3">
                <img class="movie-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png?20200912122019">
                <p class="movie-title">title3</p>
                <p class="rating"> 2</p>
            </a>
            <a class="featured" href="#4">
                <img class="movie-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png?20200912122019">
                <p class="movie-title">title4</p>
                <p class="rating"> 1</p>
            </a>
            <a class="featured" href="#5">
                <img class="movie-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png?20200912122019">
                <p class="movie-title">title5</p>
                <p class="rating"> 0</p>
            </a>
            -->
        </div>
    </div>
    
    <!-- Main Body End -->
    <!-- Footer imported from ./comps/main/footer.blade.php -->
    @include('comps.main.footer')
</body>

</html>
