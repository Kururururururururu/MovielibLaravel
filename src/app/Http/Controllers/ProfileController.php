<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ProfileController extends Controller {
    public function index($user_id = null) {

        $visitor = Auth::user();
        if ($user_id == null) {
            $page_owner = Auth::user();
        } else {
            $page_owner = DB::table('users')->where('id', $user_id)->first();
        }

        if ($page_owner === null) {
            return redirect('/');
        }
        
        return view('profile', ['page_visitor' => $visitor, 'page_owner' => $page_owner]);
    }

    public function toggleBan($id) {
        
        $active_user = Auth::user()->is_admin;
        if (!$active_user) {
            return redirect('/');
        }

        $user = DB::table('users')->where('id', $id)->first();
        if (!$user->is_banned) {
            DB::table('users')->where('id', $id)->update(['is_banned' => true]);
        } else {
            DB::table('users')->where('id', $id)->update(['is_banned' => false]);
        }

        // Get the updated user
        $updatedUser = DB::table('users')->where('id', $id)->first();

        // Return a JSON response with the new banned status
        return response()->json(['is_banned' => $updatedUser->is_banned]);
    }
    
}