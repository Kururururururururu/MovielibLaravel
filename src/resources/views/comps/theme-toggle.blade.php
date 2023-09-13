@section('theme-toggle')
    <button id="theme-toggle">
        <img src="{{asset('icons/sun.svg')}}" alt="sun" id="theme-toggle-sun">
        <img src="{{asset('icons/moon.svg')}}" alt="moon" id="theme-toggle-moon">
    </button>
    <script src="{{asset('js/anime.min.js')}}"></script>
    <script src="{{asset('js/theme-toggle.js')}}"></script>
