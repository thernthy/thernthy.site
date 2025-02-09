<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogPost;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::latest()->paginate(10);
        return view('admin.blog-posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog-posts.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'author' => 'nullable|string|max:255',
        'images' => 'nullable|array',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        'video_url' => 'nullable|url',
        'slug' => 'nullable|unique:blog_posts,slug',
    ]);

    $data = $request->only(['title', 'content', 'author', 'video_url']); 


    // Generate slug if not provided
    $data['slug'] = $request->slug 
        ? Str::slug($request->slug, '-') 
        : Str::slug($request->title, '-');

    
    // Handle image upload if provided
    $images = [];
    if ($request->hasFile('images')) {
        
        foreach ($request->file('images') as $image) {
            $path = $image->store('images', 'public');
            $images[] = $path;
        }
    }
    $data['images'] = json_encode($images);

    BlogPost::create($data); // Save data to the database

    return redirect()->route('admin.blog')
        ->with('success', 'Blog post created successfully.');
    }



    public function edit($id)
    {
        $posts = BlogPost::findOrFail($id);
        return view('admin.blog-posts.edit', compact('posts'));
    }

    public function update(Request $request, $id)
    {
        $posts = BlogPost::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'video_url' => 'nullable|url',
            'slug' => 'nullable|unique:blog_posts,slug,' . $id,
        ]);

        $data = $request->only(['title', 'content', 'author', 'video_url']); 

        // Update slug if provided
        $data['slug'] = $request->slug 
            ? Str::slug($request->slug, '-') 
            : Str::slug($request->title, '-');

        // Handle Image
        $existingImages = json_decode($posts->images, true) ?? [];
        $newImages =[];
        if ($request->hasFile('images')){
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $newImages[]= $path;
            }
        }
        $data['images'] =json_encode(array_merge($existingImages,$newImages));

        $posts->update($data);

        return redirect()->route('admin.blog')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $posts= BlogPost::findOrFail($id);

        if ($posts->images){
            foreach (json_decode($posts->images, true) as $image) {
                Storage::disk('public')->delete($image);
            }

        }
        $posts->delete();

        return redirect()->route('admin.blog')
            ->with('success', 'Post deleted successfully.');
    }

    public function deleteImage(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $imageToDelete = $request->input('image');

        $existingImages = json_decode($post->images, true) ?? [];

        // Remove the image from the storage and the array
        if (($key = array_search($imageToDelete, $existingImages)) !== false) {
            unset($existingImages[$key]);
            Storage::disk('public')->delete($imageToDelete);
        }

        // Update the post's images field
        $post->images = json_encode(array_values($existingImages));
        $post->save();

        return redirect()->route('admin.blog.edit', $id)
            ->with('success', 'Image deleted successfully.');
    }

}
