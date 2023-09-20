@section('header')
    <div class="header">
        <a href="/"><img src="/favicon.ico" class="header-logo"></a>
        <div class="header-right">
            <a href="/movies" class="nav-link">Movies</a>
            <a href="#" class="nav-link">About Us</a>
            <a href="#" class="nav-link">Contact Us</a>
            <a href="/login" class="nav-link">Login</a>
            @include('comps.main.theme-toggle')
        </div>
    </div>
