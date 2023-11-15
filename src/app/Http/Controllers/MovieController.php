<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class MovieController extends Controller
{
    public function index(Request $request, $page = null)
    {

        //Check the queried sorting method, and make sure it's an implemented method, if not default to vote_average.
        if(!$request->filled('sort') || !in_array($request->input('sort'), ['popularity', 'primary_release_date', 'vote_average'])) {
            $sort = 'vote_average';
        } else {
            $sort = $request->input('sort');
        }

        
        
        if(empty($page))    {
            $page = 1;
        }

        $requestM = Request::create('/api/popular_movies/' . $page . '/' . $sort);              

        $response = Route::dispatch($requestM);

        $genreRequest = Request::create('/api/genres', 'GET');

        $genreResponse = Route::dispatch($genreRequest);

        return view('movies', ['movies' => json_decode($response->getContent()), 'genres' => json_decode($genreResponse->getContent())]);
    }

    public function specific(Request $request)
    {
        if (!$request->has('id')) {
            return redirect('/movies');
        }

        $id = $request->input('id');

        $request = Request::create('/api/movie/' . $id);

        $movie_response = Route::dispatch($request);

        if ($movie_response->getStatusCode() == 404) {
            return redirect('/movies');
        }

        $request = Request::create('/api/movie/' . $id . '/credits');

        $credits_response = Route::dispatch($request);

        if ($credits_response->getStatusCode() == 404) {
            throw new \Exception('Credits not found');
        }

        $movie = json_decode($movie_response->getContent());
        $movie->credits = json_decode($credits_response->getContent());
        $movie->credits->cast = collect($movie->credits->cast)->sortByDesc('popularity')->take(10);

        $request = DB::table('watchlist')->where('movie_id', $id)->get();

        if (count($request) > 0) {
            $movie->watchlist = true;
        } else {
            $movie->watchlist = false;
        }

        $request = DB::table('ratings')->where('movie_id', $id)->get();

        $movie->rating = collect($request)->average('rating');

        return view('movie', ['movie' => $movie]);
    }
}
