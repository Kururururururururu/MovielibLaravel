<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class MovieController extends Controller
{
    public function index($page)
    {

        $request = Request::create('/api/popular_movies/'.$page, 'GET');

        $response = Route::dispatch($request);

        return view('movies', ['movies' => json_decode($response->getContent())]);
    }
}
