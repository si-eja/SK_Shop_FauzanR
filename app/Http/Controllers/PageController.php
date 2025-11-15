<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function index()
    {
        return view('home');
    }
    public function admin()
    {
        return view('admin.dash');
    }
    public function login(){
        return view('login');
    }
    public function regis(){
        return view('regis');
    }
}
