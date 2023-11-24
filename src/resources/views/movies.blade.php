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
    @viteReactRefresh
    @vite(['public/js/app.jsx', 'public/css/app.css/', 'public/js/pages/movies.index/movies.index.jsx', 'public/js/components/menu.jsx'])
</head>

<body>
    @include('comps.main.header')
    {{-- @include('comps.main.menu') --}}
    <div id="menu" data="{{ json_encode($genres->genres) }}"></div>
    <div id="movies-index" data="{{ json_encode($movies) }}"></div>
</body>

</html>
