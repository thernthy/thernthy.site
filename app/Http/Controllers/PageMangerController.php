<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

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
    
        // If page_id is missing, return 404
        if (!$pageId) {
            abort(404, 'Page ID is required');
        }
    
        // Fetch the page using slug and page_id
        $page = Page::where('page_slug', $slug)->where('page_id', $pageId)->first();
    
        if (!$page) {
            abort(404, 'Page not found');
        }
    
        return view('ManagePage.Edit', compact('page'));
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

    
}
