<?php

namespace App\Http\Controllers\Front;
use App\Models\HomePageContent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $contents = HomePageContent::all(); // Fetch all sections for the homepage
        return view('front.home', compact('contents'));
    }
}
