<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ProfileController extends Controller {
    public function index() {

        $user = Auth::user();
        
        return view('profile', ['my_info' => $user]);
    }
    
}