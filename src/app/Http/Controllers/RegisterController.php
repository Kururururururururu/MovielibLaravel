<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|max:30',
            'username' => 'required|max:30|unique:users',
            'email' => 'required|email|unique:users|max:30',
            'password' => 'required|confirmed|min:8|max:30'
        ]);

        $user = new User();
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        
        try {
            $user->save();
            return redirect()->route('login.show')->with('success', 'Account created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
