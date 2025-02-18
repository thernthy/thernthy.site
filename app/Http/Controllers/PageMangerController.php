<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class PageMangerController extends Controller
{
    public function index(Request $request){
        // Get the 'rows' parameter from the request, default to 25 if not provided
        $row = $request->input("rows", 25);
        
        // Fetch pages, ordered by 'created_at' in descending order, and paginated
        $pages = Page::orderBy("created_at", "desc")->paginate($row);
        // Return the view with the paginated pages
        return view("PageManger", compact("pages"));
    }

    public function edit($slug, Request $request)
    {
        $pageId = $request->query('page_id'); // Get page_id from URL query string
        $pages = Page::selectRaw('MIN(page_id) as page_id, MIN(page_slug) as page_slug, page_url')
        ->groupBy('page_url')
        ->get();

        // If page_id is missing, return 404
        if (!$pageId) {
            abort(404, 'Page ID is required');
        }
    
        // Fetch the page using slug and page_id
        $page = Page::where('page_slug', $slug)->where('page_id', $pageId)->first();
    
        if (!$page) {
            abort(404, 'Page not found');
        }
    
        return view('ManagePage.Edit', compact('page','pages'));
    }

    public function modifyed(Request $request, $slug)
    {
        // Validate incoming data
        $validated = $request->validate([
            'page_body' => 'required|string',  // Ensure the page body is a string and not empty
            'page_id' => 'required|integer|exists:pages,page_id', // Ensure the page ID exists in the database
        ]);
    
        try {
            // Find the page by page_id
            $page = Page::where('page_id', $validated['page_id'])->first();
    
            if (!$page) {
                return response()->json(['error' => 'Page not found'], 404);
            }
    
            // Update the page body with the new content
            $page->page_body = $validated['page_body'];
            $page->save();
    
            // Return a success response
            return response()->json(['success' => true, 'message' => 'Page content updated successfully']);
        } catch (\Exception $e) {
            // Return a generic error if something goes wrong
            return response()->json(['error' => 'Failed to update page content', 'details' => $e->getMessage()], 500);
        }
    }    

    public function viewCreate()
    {
        $pages = Page::selectRaw('MIN(page_id) as page_id, MIN(page_slug) as page_slug, page_url')
        ->groupBy('page_url')
        ->get();

        return view('ManagePage.Create', compact('pages'));
    }
    

    public function storeCreate(Request $request)
{
    try {
        // Validate the incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'language' => 'required|string|max:5',
            'translate' => 'required|boolean',
            'public' => 'required|boolean',
            'related_page' => 'nullable|exists:pages,page_id',  // Only if related page is provided
            'code' => 'required|string',
        ]);

        // Extract validated data
        $title = $validated['title'];
        $language = $validated['language'];
        $translate = $validated['translate'];
        $public = $validated['public'];
        $related_page = $validated['related_page'] ?? null; // Null if no related page
        $code = $validated['code'];

        if ($translate && $related_page) {
            // Find the related page
            $page = DB::table('pages')->where('page_id', $related_page)->first();

            // Check if the related page exists
            if (!$page) {
                return response()->json(['message' => 'Related page not found.'], 404);
            }

            // Insert translated page into database
            DB::table('pages')->insert([
                'page_url' => $page->page_url,
                'page_slug' => $page->page_slug,
                'locale' => $language,
                'page_body' => $code,
                'status' => $public, // Add 'public' status for the translated page
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json(['message' => 'Page created successfully!'], 201);
        }

        // Slug creation and conflict check
        $newSlug = Str::slug($title);

        // Check if the slug already exists
        $existingPage = DB::table('pages')->where('page_slug', $newSlug)->first();
        if ($existingPage) {
            return response()->json(['message' => 'Page with the same slug already exists.'], 409); // Conflict error
        }

        // Insert new page into the database
        DB::table('pages')->insert([
            'page_url' => $title,
            'page_slug' => $newSlug,
            'locale' => $language,
            'page_body' => $code,
            'status' => $public, // Add 'public' status
            'created_at' => now(),
            'updated_at' => now(),
        ]);

            return response()->json(['message' => 'Page created successfully!'], 201);

        } catch (\Exception $e) {
            // Return a response with error details
            return response()->json(['message' => 'There was an error creating the page. Please try again.', 'error' => $e->getMessage()], 500);
        }
    }
    public function destroy($page_id)
    {
        $page = Page::find($page_id);
    
        if (!$page) {
            return redirect()->back()->with('error', 'Page not found.');
        }
    
        $page->delete();
    
        return redirect()->back()->with('success', 'Page deleted successfully.');
    }
    
    
    
}
