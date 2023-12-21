<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:title" content="{{ $movie->title }}">
    <meta property="og:description" content="{{ $movie->overview }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $movie->title }} | Movie Rater</title>

    <!-- Styles -->
    <link href="{{ asset('css/css-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/specific-movie.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    {{--    @vite('movie') --}}

    <!-- scripts -->
    <script src="{{ asset('js/movie/{id}/delete-comment.js') }}"></script>

</head>

<body>
    <div id="user-id" style="display:none;position:absolute" hidden data-user-id="{{ auth()->user()->id }}"></div>
    {{-- {{dd($movie->rating)}} --}}
    <div class="outer-body-container">
        <!-- Header imported from ./comps/main/header.blade.php -->
        @include('comps.main.header')
        <!-- Menu imported from ./comps/main/menu.blade.php -->
        {{-- @include('comps.main.menu') --}}
        <!-- Main Body Start -->
        <div class="container">
            <div class="movie-header">
                <h1 class="movie-title"><a href="{{ $movie->homepage }}" class="movie-title-link">
                        {{ $movie->title }}
                    </a></h1>
                <div class="movie-rating" id="movie-rating-stars">
                    @php($rating = $movie->rating + 0.5)
                    @for ($i = 0; $i < 5; $i++)
                        @if ($rating <= 0.5)
                            <img src="/icons/star-empty.svg" alt="empty star" class="star-icon"
                                id="star-{{ $i }}">
                        @elseif($rating <= 1)
                            <img src="/icons/star-half.svg" alt="half star" class="star-icon"
                                id="star-{{ $i }}">
                        @else
                            <img src="/icons/star-filled.svg" alt="full star" class="star-icon"
                                id="star-{{ $i }}">
                        @endif
                        @php($rating--)
                    @endfor
                </div>
            </div>
            <div class="movie-container">
                <figure class="movie-poster-container">
                    <img src="https://image.tmdb.org/t/p/original{{ $movie->backdrop_path }}"
                        alt="{{ $movie->title }}" loading="lazy" class="movie-poster">
                    <figcaption class="movie-poster-caption">{{ $movie->tagline }}</figcaption>
                </figure>
                <div class="movie-info">
                    <div class="movie-info-item">
                        <p class="movie-info-item-title">Release Date:</p>
                        <p class="movie-info-item-value">{{ $movie->release_date }}</p>
                    </div>
                    <div class="movie-info-item">
                        <p class="movie-info-item-title">Runtime:</p>
                        <p class="movie-info-item-value">{{ $movie->runtime }} minutes</p>
                    </div>
                    <div class="movie-info-item">
                        <p class="movie-info-item-title">Genres:</p>
                        <div class="movie-info-item-genres">
                            @foreach ($movie->genres as $genre)
                                <p class="movie-info-item-value">{{ $genre->name }}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="movie-info-item">
                        <p class="movie-info-item-title">Reviews:</p>
                        <p class="movie-info-item-value">{{ $movie->vote_count }} reviews</p>
                    </div>
                    <div class="movie-info-item">
                        <p class="movie-info-item-title">Language:</p>
                        <p class="movie-info-item-value">
                            @foreach ($movie->spoken_languages as $language)
                                {{ $language->english_name }}
                            @endforeach
                        </p>
                    </div>
                    <div class="movie-info-item">
                        <p class="movie-info-item-title">Adult:</p>
                        <p class="movie-info-item-value">
                            @if ($movie->adult)
                                <span class="movie-info-item-value-true movie-info-item-value-pill">Yes</span>
                            @else
                                <span class="movie-info-item-value-false movie-info-item-value-pill">No</span>
                            @endif
                        </p>
                    </div>
                    <div class="movie-info-item">
                        <p class="movie-info-item-title">Budget:</p>
                        <p class="movie-info-item-value">
                            @if ($movie->budget > 1000000000)
                                ${{ number_format($movie->budget / 1000000000, 2) }} billion
                            @elseif($movie->budget > 1000000)
                                ${{ number_format($movie->budget / 1000000, 2) }} million
                            @elseif($movie->budget > 1000)
                                ${{ number_format($movie->budget / 1000, 2) }} thousand
                            @else
                                ${{ number_format($movie->budget, 2) }}
                            @endif
                        </p>
                    </div>
                    <div class="movie-info-item">
                        <p class="movie-info-item-title">Revenue:</p>
                        <p class="movie-info-item-value">
                            @if ($movie->revenue > 1000000000)
                                ${{ number_format($movie->revenue / 1000000000, 2) }} billion
                            @elseif($movie->revenue > 1000000)
                                ${{ number_format($movie->revenue / 1000000, 2) }} million
                            @elseif($movie->revenue > 1000)
                                ${{ number_format($movie->revenue / 1000, 2) }} thousand
                            @else
                                ${{ number_format($movie->revenue, 2) }}
                            @endif
                        </p>
                    </div>
                    <div class="movie-info-item">
                        <p class="movie-info-item-title">Status:</p>
                        <p class="movie-info-item-value">{{ $movie->status }}</p>
                    </div>
                    <div class="movie-info-item movie-info-item-overview">
                        <p class="movie-info-item-title">Overview</p>
                        <p class="movie-info-item-value">{{ $movie->overview }}</p>
                    </div>
                    <button class="movie-watchlist-btn" id="add-to-watchlist-btn"
                        data-watchlist="{{ $movie->watchlist ? 'true' : 'false' }}">
                        @if (!$movie->watchlist)
                            Add to Watchlist
                        @else
                            Remove from Watchlist
                        @endif
                    </button>
                </div>
            </div>
            <hr class="divider" />
            <div class="movie-info-page-2-container">
                <div class="tab-btns">
                    <div class="tab-btn active" id="more_information_btn">
                        <input type="radio" id="more_informationRadio" name="contact" value="more_information" />
                        <label for="more_informationRadio">More Information</label>
                    </div>
                    <div class="tab-btn" id="comment_btn">
                        <input type="radio" id="commentsRadio" name="contact" value="comments" />
                        <label for="commentsRadio">Comments</label>
                    </div>
                </div>
                <hr class="divider" />
                <div>
                    <div class="movie-info-extra" id="more_information_tab">
                        <h1 class="movie-info-extra-title">Cast</h1>
                        <div class="movie-casts">
                            @foreach ($movie->credits->cast as $person)
                                <div class="movie-person">
                                    @if ($person->profile_path)
                                        <img src="https://image.tmdb.org/t/p/original{{ $person->profile_path }}"
                                            alt="{{ $person->name }}" class="movie-person-img">
                                    @else
                                        <img src="{{ asset('images/person-placeholder.jpg') }}"
                                            alt="{{ $person->name }}" class="movie-person-img">
                                    @endif
                                    <p class="movie-person-name">{{ $person->name }}</p>
                                    <p class="movie-person-character">{{ $person->character }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="movie-info-extra" id="comments_tab" style="display: none">
                        <h1 class="movie-info-extra-title">Comments</h1>
                        @if ($page_visitor_isbanned)
                            <p>You cannot comment while banned.</p><br>
                        @else
                        <form class="comment-form" id="comment-form">
                            <label for="comment-input">Commenting as <code>{{ auth()->user()->name }}</code></label>
                            <textarea name="comment" id="comment-input" class="comment-form-textarea" placeholder="Write a comment..."></textarea>
                            <button class="comment-form-btn" type="submit" id="comment-btn">Submit</button>
                        </form>
                        @endif
                        <div id="comments">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Body End -->
    </div>
    <!-- Footer imported from ./comps/main/footer.blade.php -->
    @include('comps.main.footer')
    <script>
        const userId = document.getElementById("user-id").dataset.userId;
    </script>
    <script>
        window.page_visitor_isadmin = {!! json_encode($page_visitor_isadmin) !!};
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="{{ asset('js/movie/{id}/tabs-section-handler.js') }}"></script>
    <script defer src="{{ asset('js/movie/{id}/comment-section-handler.js') }}"></script>
    <script defer src="{{ asset('js/movie/{id}/add-to-watchlist-btn.js') }}"></script>
    <script defer src="{{ asset('js/movie/{id}/add-rating.js') }}"></script>
</body>

</html>
