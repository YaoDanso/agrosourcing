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

    public function sourcemap(){
        return view('website.sourcemap');
    }

    public function upcycling(){
        return view('website.upcycling');
    }

    public function research(){
        return view('website.research');
    }

    public function contact(){
        return view('website.contact');
    }
}
