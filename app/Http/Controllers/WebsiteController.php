<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function home(){
        return view('website.welcome');
    }

    public function about(){
        return view('website.about');
    }
}