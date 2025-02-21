<?php

namespace App\Http\Controllers\Front;
use App\Models\BlogPost;
use App\Http\Controllers\Controller;  //normally we add this but in the front-route we added prefix and default for BlogControllers
use App\Models\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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

    public function ListBlogs(Request $request)
    {

        $perPage = $request->input('page', 25); // Number of items per page
        $search = $request->input('search', null); // Search term
        $status = $request->input('status', 1); // Filter by status (default: 1 for active/public)
        $query = BlogPost::query();
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
        }

        if ($status !== null) {
            $query->where('status', $status);
        }
        $blogs = $query->paginate($perPage);
        return view('blogs.blogs', compact('blogs', 'search', 'status'));
    }
    public function Create(Request $request){
        $pages = Page::selectRaw('MIN(page_id) as page_id, MIN(page_slug) as page_slug, page_url')
        ->groupBy('page_url')
        ->get();
        return view('blogs.create', compact('pages'));
    }
    public function Store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'language' => 'required|string',
            'root_path' => 'required|string',
            'translate' => 'required|boolean',
            'public' => 'required|boolean',
            'related_page' => 'nullable|string',
            'cover_picture' => 'required|string',
            'code' => 'required|string', // Ensure the code field is not empty
        ]);
    
        try {
            $newSlug = Str::slug($request->title);
            // Store the blog post data
            $blog = new BlogPost();
            $blog->title = $request->title;
            $blog->language = $request->language;
            $blog->root_path = $request->root_path;
            $blog->url_path = $request->root_path .'/'.$newSlug;
            $blog->author = Auth::user()->name;
            $blog->slug = $newSlug;
            $blog->status = $request->public;
            $blog->used_page = $request->related_page ?? null; // Assign related_page to used_page if it exists
            $blog->content = $request->code;
            $blog->cover_image = $request->cover_picture;
            $blog->save();
    
            return response()->json(['success' => true, 'message' => 'Blogs creation successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create blog post', 'error' => $e->getMessage()], 500);
        }
    }
    

    public function View(){
        
    }
}
