<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    // Show all categories
    public function index()
    {
        $categories = Category::withCount('photos')->get();
        return view('site.gallery.index', compact('categories'));
    }

    // Show photos in a category
    public function showCategory($id)
    {
        $category = Category::with('photos')->findOrFail($id);
        return view('site.gallery.category', compact('category'));
    }

    // AJAX: Load more photos
    public function loadMorePhotos(Request $request)
    {
        $category = Category::findOrFail($request->category_id);
        $photos = $category->photos()->latest()->paginate(8);

        return response()->json([
            'html' => view('gallery.partials.photos', compact('photos'))->render(),
            'next_page' => $photos->nextPageUrl(),
        ]);
    }
}