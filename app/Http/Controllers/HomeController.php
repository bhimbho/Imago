<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')
        ->with('images', Image::where('user_id', Auth::user()->id)->get())
        ->with('private', Image::where([
            ['user_id', Auth::user()->id],
            ['permission',0]
            ])->get())
        ->with('public', Image::where([
            ['user_id', Auth::user()->id],
            ['permission',1]
            ])->get());
    }
}
