<?php

namespace App\Http\Controllers\Admin;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        return view('admin.messages.show', compact('message'));
    }

    public function destroy($id)
    {
        ContactMessage::destroy($id);
        return redirect()->route('admin.messages')->with('success', 'Message deleted!');
    }
}
