@section('theme-toggle')
    <button id="theme-toggle" class="primary-button">
        <img src="{{ asset('icons/sun.svg') }}" alt="sun" id="theme-toggle-sun" class="icon">
        <img src="{{ asset('icons/moon.svg') }}" alt="moon" id="theme-toggle-moon" class="icon">
    </button>
    <script src="{{ asset('js/anime.min.js') }}"></script>
    <script src="{{ asset('js/theme-toggle.js') }}"></script>
