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

Route::get('/popular_movies/{page}/{sort}', function (Request $request, $page, $sort) {

    $response = Http::withoutVerifying()
        ->withToken(env('TMDB_PUBLIC_API_KEY'))
        ->get('https://api.themoviedb.org/3/discover/movie?', [
            'language' => 'en-US',
            'sort_by' => $sort . '.desc',
            'page' => $page,
            'primary_release_date.lte' => '2023-12-31',
            'vote_count.gte' => '5'
        ]);



        /*
        ->withToken(env('TMDB_PUBLIC_API_KEY'))
        ->get('https://api.themoviedb.org/3/movie/popular?language=en-US', [
            'page' => $page
        ]);
        */

    return response()->json($response->json());
});

Route::get('/movie/{id}', function ($id) {
    $response = Http::withoutVerifying()
        ->withToken(env('TMDB_PUBLIC_API_KEY'))
        ->get('https://api.themoviedb.org/3/movie/' . $id . '?language=en-US');

    if ($response->notFound()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Movie not found'
        ], 404);
    }

    return response()->json($response->json());
});

Route::get('/movie/{id}/credits', function ($id) {
    $response = Http::withoutVerifying()
        ->withToken(env('TMDB_PUBLIC_API_KEY'))
        ->get('https://api.themoviedb.org/3/movie/' . $id . '/credits?language=en-US');

    if ($response->notFound()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Movie not found'
        ], 404);
    }

    return response()->json($response->json());
});

Route::get('/movie/{id}/comments', function ($id) {

    $comments = DB::table('comments')->where('movie_id', $id)->get();

    return response()->json([
        'status' => 'success',
        'comments' => $comments
    ]);
});

Route::post('/movie/{id}/comment', function (Request $request, $id) {

    try {
        $comment = $request->input('comment');

        if ($comment == '') {
            return response()->json([
                'status' => 'error',
                'message' => 'Comment cannot be empty'
            ], 400);
        }

        $validated = $request->validate([
            'comment' => 'required|max:255',
        ]);


        $author = $request->input('author');

        if ($author == '') {
            $author = 'Anonymous';
        }


        $insert = DB::table('comments')->insert([
            'movie_id' => $id,
            'comment' => $validated['comment'],
            'author' => $author,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if (!$insert) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error inserting comment'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
        ]);

    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error inserting comment',
            'exception' => $e->getMessage()
        ], 500);
    }
});

Route::delete('/movie/{id}/watchlist', function(Request $request, $id) {
    try {
        $delete = DB::table('watchlist')->where('movie_id', $id)->where('author', 'Anonymous')->delete();

        if (!$delete) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error deleting movie from watchlist'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
        ]);

    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error deleting movie from watchlist',
            'exception' => $e->getMessage()
        ], 500);
    }
});

Route::post('/movie/{id}/watchlist', function(Request $Request, $id){
    try {
        /*$validated = $Request->validate([
            'user_id' => 'required',
        ]);*/

        $insert = DB::table('watchlist')->insert([
//            'user_id' => $validated['user_id'],
            'author' => 'Anonymous',
            'movie_id' => $id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if (!$insert) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error adding movie to watchlist'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
        ]);

    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error adding movie to watchlist',
            'exception' => $e->getMessage()
        ], 500);
    }
});

Route::post('/movie/{id}/rating', function(Request $request, $id) {
    try {
        $rating = $request->input('rating');

        if ($rating == '') {
            return response()->json([
                'status' => 'error',
                'message' => 'Rating cannot be empty'
            ], 400);
        }

        $validated = $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $insert = DB::table('ratings')->insert([
            'movie_id' => $id,
            'author' => 'Anonymous',
            'rating' => $validated['rating'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if (!$insert) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error inserting rating'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
        ]);

    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error inserting rating',
            'exception' => $e->getMessage()
        ], 500);
    }
});

Route::get('/genres', function () {
    $response = Http::withoutVerifying()
        ->withToken(env('TMDB_PUBLIC_API_KEY'))
        ->get('https://api.themoviedb.org/3/genre/movie/list?language=en-US');

    return response()->json($response->json());
});