<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        if (in_array($lang, ['en', 'kh'])) { // Add more languages if needed
            session(['locale' => $lang]); // Store in session
            session()->save(); // Force saving session
           
        }
        return redirect()->back();
    }
}