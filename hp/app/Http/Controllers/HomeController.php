<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function users()
    {
        return view('realtimecrud.crud');
    }
    public function home()
    {
        return view('admin.solution');
    }
    public function solution()
    {
        return view('admin.adminsolution');
    }
    public function detail()
    {
        
        return view('admin');
        
    }
}
