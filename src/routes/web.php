<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/movies/{page?}',[\App\Http\Controllers\MovieController::class,'index'])->name('movies.show');
Route::get('/login',[\App\Http\Controllers\LoginController::class,'index'])->name('login.show');
Route::get('/register',[\App\Http\Controllers\RegisterController::class,'index'])->name('register.show');


Route::get('/movie', [\App\Http\Controllers\MovieController::class,'specific'])->name('movie.show');
