<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/movie/{id}', array('as' => 'movie', function ($id) {
    $response = Http::withoutVerifying()
        ->withToken(env('TMDB_PUBLIC_API_KEY'))
        ->get('https://api.themoviedb.org/3/movie/'.$id.'?language=en-US');

    if ($response->notFound()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Movie not found'
        ], 404);
    }

    return response()->json($response->json());
}));

Route::get('/movie/{id}/credits', array('as' => 'movie_credits', function ($id) {
    $response = Http::withoutVerifying()
        ->withToken(env('TMDB_PUBLIC_API_KEY'))
        ->get('https://api.themoviedb.org/3/movie/'.$id.'/credits?language=en-US');

    if ($response->notFound()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Movie not found'
        ], 404);
    }

    return response()->json($response->json());
}));

Route::get('/movie/{id}/comments', array('as' => 'movie_comments', function ($id) {

    $comments = DB::table('comments')->where('movie_id', $id)->get();

    return response()->json([
        'status' => 'success',
        'comments' => $comments
    ]);
}));

Route::post('/movie/{id}/comment', array('as' => 'movie_comment', function (Request $request, $id) {

    $validated = $request->validate([
        'comment' => 'required|max:255',
    ]);

    $author = $request->input('author');

    if ($author == '') {
        $author = 'Anonymous';
    }

    try {
        $insert = DB::table('comments')->insert([
            'movie_id' => $id,
            'comment' => $validated['comment'],
            'author' => $author,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error inserting comment'
        ], 500);
    }

    if (!$insert) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error inserting comment'
        ], 500);
    }

    return response()->json([
        'status' => 'success',
    ]);
}));
