<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ProfileController extends Controller {
    public function index($username = null) {

        $visitor = Auth::user();
        if ($username == null) {
            $page_owner = Auth::user();
        } else {
            $page_owner = DB::table('users')->where('username', $username)->first();
        }

        if ($page_owner === null) {
            return redirect('/');
        }
        
        return view('profile', ['page_visitor' => $visitor, 'page_owner' => $page_owner]);
    }

    public function toggleBan($id) {
        
        $active_user = Auth::user()->is_admin;
        if ($active_user == 0) {
            return redirect('/');
        }

        $user = DB::table('users')->where('id', $id)->first();
        if ($user->is_banned == 0) {
            DB::table('users')->where('id', $id)->update(['is_banned' => 1]);
        } else {
            DB::table('users')->where('id', $id)->update(['is_banned' => 0]);
        }

        // Get the updated user
        $updatedUser = DB::table('users')->where('id', $id)->first();

        // Return a JSON response with the new banned status
        return response()->json(['is_banned' => $updatedUser->is_banned]);
    }
    
}