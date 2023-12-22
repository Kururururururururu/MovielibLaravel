<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class WatchlistController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        $movie_ids = DB::table('watchlist')->where('user_id', $userId)->pluck('movie_id')->toArray();
        
        $wl_movies = [];
        
        foreach ($movie_ids as $movie_id) {
            $request = Request::create('/api/movie/' . $movie_id);
            $movie_response = Route::dispatch($request);
            $wl_movie = json_decode($movie_response->getContent());
            $wl_movies[] = $wl_movie;
        }
        
        return view('watchlist', ['wl_movies' => $wl_movies]);
    }
}

