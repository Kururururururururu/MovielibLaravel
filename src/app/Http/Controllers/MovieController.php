<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class MovieController extends Controller
{
    public function index($page)
    {

        $request = Request::create('/api/popular_movies/' . $page);

        $response = Route::dispatch($request);

        return view('movies', ['movies' => json_decode($response->getContent())]);
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

        $request = DB::table('watchlist')->where('movie_id', $id)->where('author', 'Anonymous')->get();

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
