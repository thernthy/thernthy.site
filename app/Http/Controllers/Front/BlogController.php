<?php

namespace App\Http\Controllers\Front;
use App\Models\BlogPost;
use App\Http\Controllers\Controller;  //normally we add this but in the front-route we added prefix and default for BlogControllers
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::latest()->paginate(5);
        return view('front.blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)->firstOrFail();
        return view('front.blog.show', compact('post'));
    }

    public function ListBlogs(Request $request){
        return view('blogs.blogs');
    }
    public function Create(Request $request){
        $blogs = BlogPost::select('id','title','slug')->get();
        return view('blogs.create', compact('blogs'));
    }

    public function View(){
        
    }
}
