<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ProfileController extends Controller {
    public function index() {
        $userId = Auth::id();
        
        $profile_info = DB::table('users')->where('id', $userId)->get();
        
        return view('profile', ['profile-info' => $profile_info]);
    }
    
}