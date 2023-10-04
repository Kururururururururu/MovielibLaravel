@section('header')
    <div class="header">
        <a href="{{ url('/') }}"><img src="/favicon.ico" class="header-logo"></a>
        <div class="header-right">
            <a href="#" class="nav-link">Movies</a>
            <a href="#" class="nav-link">About Us</a>
            <a href="#" class="nav-link">Contact Us</a>
            <a href="{{ url('/login') }}" class="nav-link">Login</a>
            @include('comps.theme-toggle')
        </div>
    </div>
