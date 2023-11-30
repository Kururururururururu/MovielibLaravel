<?php

use Illuminate\Http\request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

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

Route::middleware('auth:sanctum')->get('/user', function (request $request) {
    return $request->user();
});

Route::get('/popular_movies/{page}/{sort}', function (request $request, $page, $sort) {

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

    $comments = DB::table('comments')
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->where('comments.movie_id', $id)
        ->select('comments.*', 'users.username')
        ->get();

    return response()->json([
        'status' => 'success',
        'comments' => $comments
    ]);
});

Route::post('/movie/{id}/comment', function (request $request, $id) {

    try {
        $body = json_decode($request->getContent(), true);
        $comment = $body['comment'];

        if ($comment == '') {
            return response()->json([
                'status' => 'error',
                'message' => 'Comment cannot be empty'
            ], 400);
        }

        $comment_insert_params = [
            'id' => Uuid::uuid4()->toString(),
            'movie_id' => $id,
            'comment' => $comment,
            'user_id' => getUserIdFromRequest($request),
            'created_at' => now(),
            'updated_at' => now()
        ];

        $insert = DB::table('comments')->insert($comment_insert_params);

        if (!$insert) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error inserting comment'
            ], 500);
        }

        $comment_insert_params['created_at'] = now()->toDateTimeString();
        $comment_insert_params['updated_at'] = now()->toDateTimeString();

        return response()->json([
            'status' => 'success',
            'comment' => $comment_insert_params
        ]);
    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error inserting comment',
            'exception' => $e->getMessage()
        ], 500);
    }
});

Route::delete('/movie/{id}/watchlist', function (request $request, $id) {
    try {
        $delete = DB::table('watchlist')->where('movie_id', $id)->where('user_id', getUserIdFromRequest($request))->delete();

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

function getUserIdFromRequest($request)
{
    $requestData = json_decode($request->getContent(), true);
    $userId = $requestData['userId'];

    return $userId;
}

Route::post('/movie/{id}/watchlist', function (Request $request, $id) {
    try {

        $insert = DB::table('watchlist')->insert([
            'id' => Uuid::uuid4()->toString(),
            'user_id' => getUserIdFromRequest($request),
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

Route::post('/movie/{id}/rating', function (request $request, $id) {
    try {
        $rating = json_decode($request->getContent(), true)['rating'];

        error_log(json_encode(['rating' => $rating, 'userId' => getUserIdFromRequest($request), 'movieId' => $id]));

        if ($rating == '') {
            return response()->json([
                'status' => 'error',
                'message' => 'Rating cannot be empty'
            ], 400);
        }

        $insert = DB::table('ratings')->insert([
            'id' => Uuid::uuid4()->toString(),
            'movie_id' => $id,
            'user_id' => getUserIdFromRequest($request),
            'rating' => $rating,
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
