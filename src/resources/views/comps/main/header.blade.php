@section('header')
    <header class="header">
        <a href="{{ url('/') }}"><img src="/favicon.ico" class="header-logo"></a>
        <nav class="header-right">
            <a href="/movies" class="nav-link">Movies</a>
            @if (Auth::check())
                <a href="{{ url('/watchlist') }}" class="nav-link">Watchlist</a>
            @endif
            <a href="#" class="nav-link">About Us</a>
            <a href="#" class="nav-link">Contact Us</a>
            @if (Auth::check())
                <a href="{{ url('/profile') }}" class="nav-link">Profile</a>
            @endif
            @if (Auth::check())
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="nav-link">Logout</a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ url('/login') }}" class="nav-link">Login</a>
            @endif
            @include('comps.main.theme-toggle')
        </nav>
    </header>
    <div class="header-container"></div>
