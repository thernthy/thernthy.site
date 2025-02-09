<?php

namespace App\Http\Controllers\Front;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        ContactMessage::create($request->all());

        return redirect()->route('contact')->with('success', 'Your message has been sent!');
    }
}
