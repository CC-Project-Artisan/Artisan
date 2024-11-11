<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function shop()
    {
        return view('pages.shop');
    }

    public function about()
    {
        return view('pages.about');
    }
}
