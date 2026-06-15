<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    // List all photos
    public function index()
    {
        $photos = Photo::with('category')->latest()->paginate(20);
        return view('admin.photos.index', compact('photos'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::all();
        return view('admin.photos.create', compact('categories'));
    }

    // Store new photos (multiple upload)
    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                $image->move(public_path('photo'), $imageName);

                Photo::create([
                    'image_path' => 'photo/' . $imageName, // inside public/photo
                    'category_id' => $request->category_id,
                    'featured' => $request->has('featured'),
                    'tall' => $request->has('tall'),
                ]);
            }
        }

        return redirect()->route('admin.photos.index')->with('success', 'Photos uploaded successfully!');
    }

    // Show edit form
    public function edit(Photo $photo)
    {
        $categories = Category::all();
        return view('admin.photos.edit', compact('photo', 'categories'));
    }

    // Update photo (single)
    public function update(Request $request, Photo $photo)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = [
            'category_id' => $request->category_id,
            'featured' => $request->has('featured'),
            'tall' => $request->has('tall'),
        ];

        if ($request->hasFile('image')) {
            if (file_exists(public_path($photo->image_path))) {
                unlink(public_path($photo->image_path));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('photo'), $imageName);
            $data['image_path'] = 'photo/' . $imageName;
        }

        $photo->update($data);

        return redirect()->route('admin.photos.index')->with('success', 'Photo updated successfully!');
    }

    // Delete photo
    public function destroy(Photo $photo)
    {
        if (file_exists(public_path($photo->image_path))) {
            unlink(public_path($photo->image_path));
        }
        $photo->delete();
        return redirect()->route('admin.photos.index')->with('success', 'Photo deleted successfully!');
    }
}
