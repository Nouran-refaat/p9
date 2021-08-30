<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        // dd(Auth::guard('web')->user()->phone);
        return view('backend.dashboard');
    }
}
