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
            // Same regex as the frontend.
            'name' => 'required|max:30|regex:/^[a-zA-Z]+$/',
            // Same regex as the frontend.
            'username' => 'required|max:30|unique:users|regex:/^[a-zA-Z0-9]*$/',
            // Same regex as the frontend, but the email in laravel checks if its an email format.
            'email' => 'required|email|unique:users|max:30|',
            // Same regex as the frontend.
            'password' => 'required|confirmed|min:8|max:30|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).+$/'
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
