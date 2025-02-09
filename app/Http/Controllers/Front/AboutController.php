<?php

namespace App\Http\Controllers\Front;
use App\Models\AboutPageContent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AboutController extends Controller
{
    public function index()
    {
        $contents = AboutPageContent::all();
        return view('front.about', compact('contents'));
    }

}
