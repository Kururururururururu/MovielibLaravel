<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Movie Rater</title>
    <!-- Styles -->
    <link href="{{ asset('css/css-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>
<body>
    <Header>
        @include('comps.main.header')
    </Header>
    <Nav>
        
    </Nav>
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
    <footer>

    </footer>
</body>