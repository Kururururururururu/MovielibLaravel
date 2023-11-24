<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:title" content="{{ $movie->title }}">
    <meta property="og:description" content="{{ $movie->overview }}">
    <title>{{ $movie->title }} | Movie Rater</title>

    <!-- Styles -->
    <link href="{{ asset('css/css-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/specific-movie.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    {{--    @vite('movie') --}}
    @viteReactRefresh
    @vite(['public/js/app.jsx', 'public/css/app.css/', 'public/js/pages/movie.index/movie.index.jsx'])
</head>

<body>
    <div id="user-id" style="display:none;position:absolute" hidden data-user-id="{{ auth()->user()->id }}"></div>
    <div id="user-name" style="display:none;position:absolute" hidden data-user-name="{{ auth()->user()->name }}"></div>
    {{-- {{dd($movie->rating)}} --}}
    <div class="outer-body-container">
        <!-- Header imported from ./comps/main/header.blade.php -->
        @include('comps.main.header')
        <!-- Menu imported from ./comps/main/menu.blade.php -->
        {{-- @include('comps.main.menu') --}}
        <!-- Main Body Start -->
        <div class="container">
            <div id="movie-index" data="{{ json_encode($movie) }}"></div>
        </div>
        <!-- Main Body End -->
    </div>
    <!-- Footer imported from ./comps/main/footer.blade.php -->
    @include('comps.main.footer')
</body>

</html>
