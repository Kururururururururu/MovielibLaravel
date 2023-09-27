@section('menu')
    <div class="menu">
        <div class="searchbar">
            <input type="text" placeholder="Search" class="search">
            <button class="primary-button" id="">Search</button>
        </div>
        <pre>







        </pre>
        <div class="tag">
            <h3>Genres</h3>
            <div class="tag-list">
                @foreach($genres->genres as $genre)
                    <div class="tag-item">
                        <input type="checkbox" id="{{$genre->id}}" name="{{$genre->name}}">
                        <label for="{{$genre->id}}">{{$genre->name}}</label>
                    </div>
                @endforeach
            </div>      
            <button class="primary-button" id="">Apply</button>  
        </div>
    </div>