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
            // Make sure that the name is only letters and spaces, like the frontend
            'name' => 'required|max:30|[a-zA-Z][a-zA-Z ]',
            // Make sure that the username contians letters, numbers, underscores and dashes
            'username' => 'required|unique:users|max:20|[a-zA-Z0-9][a-zA-Z0-9_-]*',
            // Make sure that the email is a valid email (not the best regex, but it works)
            'email' => 'required|email|[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}',
            // This help to make sure that the data recieved is a password min 8 characters,that contain an uppercase letter, 
            // a lowercase letter, number and a speial chracter
            'password' => 'required|min:8|confirmed|[A-Z]|[a-z]|[0-9]|[^A-Za-z0-9]'
        ]);

        if ($validator->fails()) {
            return redirect('user/create')
                        ->withErrors($validator)
                        ->withInput();
        }
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
