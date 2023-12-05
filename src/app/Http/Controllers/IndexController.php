<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class IndexController extends Controller
{
    public function index(Request $request)
    {   
        $requestM = Request::create('/api/popular_movies/1/vote_average');              

        $response = Route::dispatch($requestM);

        $movies = json_decode($response->getContent(), true);
        
        $movies = array_slice($movies, 0, 10);  // Limit the number of results to 10

        return view('index', ['movies' => json_decode($response->getContent())]);
    }
}
