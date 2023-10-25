@section('menu')
    <div class="menu">
        <script src="{{ asset('js/movie_list/menu_sort_selector.js') }}"></script>
        <pre>

        </pre>
        <div class="searchbar-box">
            <input type="text" placeholder="Search" class="searchbar">
            <button class="searchbutton primary-button" id=""><img src="{{ asset('icons/search.svg') }}" alt="search" class="icon"></button>
        </div>
        <pre>


        </pre>
        <div class="sort-by">
            <h1 class="text-2">Sort by</h1>
            <pre>

            </pre>
            <div class="sortby-list">
                <div class="sortby-item">
                    <input type="radio" id="sortby-vote-average" name="sortby" value="vote_average" checked>
                    <label for="sortby-vote-average">Vote average</label>
                </div>
                <div class="sortby-item">
                    <input type="radio" id="sortby-release-date" name="sortby" value="primary_release_date">
                    <label for="sortby-release-date">Release date</label>
                </div>
                <div class="sortby-item">
                    <input type="radio" id="sortby-popularity" name="sortby" value="popularity">
                    <label for="sortby-popularity">Popularity</label>
                </div>
            </div>
        </div>
        <pre>


        </pre>
        <div class="tag">
            <h1 class="text-2">Genres</h1>
            <pre>

            </pre>
            
            <div class="tag-list">
                @foreach($genres->genres as $genre)
                    <div class="tag-item">
                        <input type="checkbox" id="{{$genre->id}}" name="{{$genre->name}}">
                        <label for="{{$genre->id}}">{{$genre->name}}</label>
                    </div>
                @endforeach
            </div>        
        </div>
        <button class="primary-button" id="">Apply</button>
    </div>