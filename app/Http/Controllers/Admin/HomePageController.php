<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomePageContent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomePageController extends Controller
{

    public function index()
    {
        $contents = HomePageContent::all();
        return view('admin.home-page.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.home-page.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'section_title' => 'required|string|max:255',
            'section_content' => 'required|string',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_url' => 'nullable|url',
        ], [
            'section_title.required' => 'The title is required.',
            'section_content.required' => 'The content is required.',
            'images.array' => 'The images must be an array.',
            'images.*.image' => 'Each file must be an image.',
            'video_url.url' => 'The video URL must be a valid URL.',
        ]);

        $data = $request->only(['section_title', 'section_content', 'video_url']);

        // Handle image uploads
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $images[] = $path;
            }
            $data['images'] = json_encode($images);
        }

        HomePageContent::create($data);

        return redirect()->route('admin.home')->with('success', 'Page created successfully.');
    }

    public function edit($id)
    {
        $content = HomePageContent::findOrFail($id);
        return view('admin.home-page.edit', compact('content'));
    }

    public function update(Request $request, $id)
    {
        $content = HomePageContent::findOrFail($id);

        $request->validate([
            'section_title' => 'required|string|max:255',
            'section_content' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_url' => 'nullable|url',
        ]);

        $data = $request->only(['section_title', 'section_content', 'video_url']);

        // Handle new image uploads
        if ($request->hasFile('images')) {
            // Delete old images
            if ($content->images) {
                foreach (json_decode($content->images, true) as $image) {
                    Storage::disk('public')->delete($image);
                }
            }

            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('uploads', 'public');
            }
            $data['images'] = json_encode($images);
        }

        $content->update($data);

        return redirect()->route('admin.home')->with('success', 'Home page section updated successfully!');
    }

    public function destroy($id)
    {
        $content = HomePageContent::findOrFail($id);

        // Delete associated images
        if ($content->images) {
            foreach (json_decode($content->images, true) as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $content->delete();

        return redirect()->route('admin.home')->with('success', 'Home page section deleted successfully!');
    }

    public function deleteImage(Request $request, $id)
    {
        $content = HomePageContent::findOrFail($id);

        $image = $request->input('image'); // Get the image path from the request
        $images = json_decode($content->images, true); // Decode the images JSON

        // Check if the image exists in the array
        if (($key = array_search($image, $images)) !== false) {
            unset($images[$key]); // Remove the image from the array
            Storage::disk('public')->delete($image); // Delete the image file from storage
            $content->images = json_encode(array_values($images)); // Update the images JSON
            $content->save(); // Save the updated content
        }

        return redirect()->route('admin.home.edit', $id)->with('success', 'Image deleted successfully!');
    }

}
