<!doctype html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:title" content="Popular Movies">
    <meta property="og:description" content="Popular Movies">
    <meta property="og:image" content="http://localhost:8000/og.png">
    <title>Popular Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body class="p-4 bg-black">
@include('comps.main.menu')
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-xl-5 g-4">
    @foreach($movies->results as $movie)
        <div class="col">
            <div class="card h-100">
                <img src="https://image.tmdb.org/t/p/original/{{$movie->poster_path}}" class="card-img-top"
                     alt="{{$movie->title}}">
                <div class="card-body">
                    <h5 class="card-title">{{$movie->title}}</h5>
                    <p class="card-text">{{$movie->overview}}</p>
                    <p class="card-text"><small class="text-muted">{{$movie->release_date}}</small></p>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center mt-4 gap-4">
    @php
        $currentPage = $movies->page;
        $total_pages = $movies->total_pages;
    @endphp

    @if($currentPage > 1)
        <a href="/movies/{{$currentPage - 1}}" class="btn btn-primary">Previous</a>
    @endif

    @for($i = $currentPage - 2; $i <= $currentPage + 2; $i++)
        @if($i > 0 && $i <= $total_pages)
            @if($currentPage == $i)
                <a href="/movies/{{$i}}" class="btn btn-primary">{{$i}}</a>
            @else
                <a href="/movies/{{$i}}" class="btn btn-outline-primary">{{$i}}</a>
            @endif
        @endif
    @endfor

    @if($currentPage < $total_pages)
        <a href="/movies/{{$currentPage + 1}}" class="btn btn-primary">Next</a>
    @endif

</div>
</body>
</html>
