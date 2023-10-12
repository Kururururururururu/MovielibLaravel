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


    function store(){
        $data = request()->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        try{
            $user = new User();
            $user->name = $data ['name'];
            $user->username = $data['username'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            return redirect()->route('login.show')->with('success', 'Account created successfully');
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong');
        }

        

    }
}
