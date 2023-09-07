<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/popular_movies/{page}', array('as' => 'popular_movies', function ($page) {
    $response = Http::withoutVerifying()
        ->withToken(env('TMDB_PUBLIC_API_KEY'))
        ->get('https://api.themoviedb.org/3/movie/popular?language=en-US', [
        'page' => $page
    ]);

    return response()->json($response->json());
}));
