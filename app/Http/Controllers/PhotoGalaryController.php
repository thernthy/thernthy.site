<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PhotoGalaryController extends Controller
{
    // Function to list images/URLs in the gallery
    public function Lists(Request $request)
    {
        $folderPath = public_path('thernthy-galary');
        $jsonLinkPath = public_path('galary.json');
    
        // Get all files from the folder
        $files = File::files($folderPath);
    
        // Filter only image files
        $images = array_filter($files, function ($file) {
            return in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
        });
    
        // Convert objects to an array for pagination
        $images = array_values($images);
    
        // Read existing gallery data from the JSON file
        $galleryData = [];
        if (File::exists($jsonLinkPath)) {
            $galleryData = json_decode(File::get($jsonLinkPath), true);
        }
    
        // Paginate the images
        $perPage = $request->input('per_page', 25);
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $perPage;
    
        // Get paginated images
        $paginatedImages = array_slice($images, $offset, $perPage);
    
        // Prepare the final image data (file path only)
        $finalImages = array_map(function ($image) {
            return [
                'filename' => $image->getFilename(),
                'path' => asset('thernthy-galary/' . $image->getFilename())
            ];
        }, $paginatedImages);
    
        // Merge JSON gallery data with filesystem images (optional)
        $mergedImages = array_merge($galleryData, $finalImages);
    
        return view('Galary.index', [
            'images' => $mergedImages,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
        ]);
    }
    public function ApiFetch(Request $request)
    {
        $folderPath = public_path('thernthy-galary');
        $jsonLinkPath = public_path('galary.json');
        
        // Get all files from the folder
        $files = File::files($folderPath);
        
        // Filter only image files
        $images = array_filter($files, function ($file) {
            return in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
        });
        
        // Convert objects to an array for pagination
        $images = array_values($images);
        
        // Read existing gallery data from the JSON file
        $galleryData = [];
        if (File::exists($jsonLinkPath)) {
            $galleryData = json_decode(File::get($jsonLinkPath), true);
        }
        
        // Paginate the images
        $perPage = $request->input('per_page', 25);
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        
        // Get paginated images
        $paginatedImages = array_slice($images, $offset, $perPage);
        
        // Prepare the final image data (file path only)
        $finalImages = array_map(function ($image) {
            return [
                'filename' => $image->getFilename(),
                'path' => asset('thernthy-galary/' . $image->getFilename())
            ];
        }, $paginatedImages);
        
        // Merge JSON gallery data with filesystem images (optional)
        $mergedImages = array_merge($galleryData, $finalImages);
        
        // Return the merged image data as JSON response for the front-end
        return response()->json([
            'images' => $mergedImages,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'totalImages' => count($images), // Total number of images in the directory
            'totalPages' => ceil(count($images) / $perPage) // Calculate total pages
        ]);
    }
    
    

    // Function to handle file upload (image)
    public function uploadImage(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'image' => 'required', // Max 2MB for images
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Get the uploaded image
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Save the image to the 'thernthy-galary' folder
        $image->move(public_path('thernthy-galary'), $imageName);

        // Return success message
        return response()->json(['success'=>'Image has been uploaded.'],200);
    }

    // Function to handle URL upload
    public function uploadUrl(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'url' => 'required|url', // Ensure it's a valid URL
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Get the URL input from the request
        $url = $request->input('url');

        // Read existing gallery data from the JSON file
        $jsonLinkPath = public_path('galary.json');
        $galleryData = [];
        if (File::exists($jsonLinkPath)) {
            $galleryData = json_decode(File::get($jsonLinkPath), true);
        }

        // Add the new URL and the current date to the gallery data
        $galleryData[] = [
            'url' => $url,
            'date' => now()->toDateString(),
        ];

        // Write the updated data back to the JSON file
        File::put($jsonLinkPath, json_encode($galleryData, JSON_PRETTY_PRINT));

        return back()->with('success', 'URL has been uploaded to the gallery.');
    }

    // Function to remove an item (image or URL) from the gallery
    public function removeItem(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'url' => 'nullable|url',
            'image' => 'nullable|string', // Ensure it's a valid image file path
        ]);

        $jsonLinkPath = public_path('galary.json');

        // Check if the JSON file exists for URL removal
        if ($request->input('url') && File::exists($jsonLinkPath)) {
            // Read existing gallery data from the JSON file
            $galleryData = json_decode(File::get($jsonLinkPath), true);

            // Remove the URL from the gallery data
            $galleryData = array_filter($galleryData, function ($entry) use ($request) {
                return $entry['url'] !== $request->input('url');
            });

            // Reindex the array to prevent numeric keys from breaking
            $galleryData = array_values($galleryData);

            // Write the updated data back to the JSON file
            File::put($jsonLinkPath, json_encode($galleryData, JSON_PRETTY_PRINT));

            return back()->with('success', 'URL has been removed from the gallery.');
        }

        // For image file removal
        if ($request->input('image')) {
            $imagePath = public_path('thernthy-galary/' . $request->input('image'));
            if (File::exists($imagePath)) {
                File::delete($imagePath);
                return back()->with('success', 'Image has been removed from the gallery.');
            } else {
                return back()->with('error', 'Image not found.');
            }
        }

        return back()->with('error', 'No valid input provided.');
    }
}

