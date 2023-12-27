<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Movie Rater</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/css-reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/carousel.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
    <script src="{{ asset('js/carousel.js') }}" defer></script>
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
        <div class="top5" data-movies="{{ json_encode($movies) }}">
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const container = document.querySelector('.top5');
                    const moviesData = JSON.parse(container.getAttribute('data-movies'));
                    const movieCarousel = new MovieCarousel(container, moviesData, 10);
                });
            </script>
        </div>
    </section>

    <!-- Main Body End -->
    <!-- Footer imported from ./comps/main/footer.blade.php -->
    @include('comps.main.footer')
</body>

</html>