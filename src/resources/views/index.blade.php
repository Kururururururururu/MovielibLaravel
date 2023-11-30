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
    @viteReactRefresh
    @vite(['public/js/app.jsx', 'public/css/app.css', 'public/js/pages/index.jsx'])
</head>

<body>
    <header>
        @include('comps.main.header')
    </header>
    <!-- Header imported from ./comps/main/header.blade.php -->
    <div class="navbar"></div>
    <!-- Main Body Start -->
    <div id="index"></div>
    <!-- Main Body End -->
    <!-- Footer imported from ./comps/main/footer.blade.php -->
    @include('comps.main.footer')
</body>

</html>
