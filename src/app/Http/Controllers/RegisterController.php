<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }
}
