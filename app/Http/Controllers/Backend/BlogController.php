<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::latest()->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = ['Stage Design', 'Marketing', 'Dance Techniques', 'Event Planning', 'Judging Tips'];
        return view('admin.blog.create', compact('categories'));
    }

  public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'excerpt' => 'required|max:300',
        'featured_image' => 'required|mimes:jpg,jpeg,png,gif,webp|max:2048',
    'additional_images.*' => 'nullable|mimes:jpg,jpeg,png,gif,webp|max:2048',
        'published_at' => 'required|date'
    ]);

    // Ensure directory exists
    if (!file_exists(public_path('event/blog'))) {
        mkdir(public_path('event/blog'), 0755, true);
    }

    // Featured image
    $image = $request->file('featured_image');
    $imageName = time() . '_' . $image->getClientOriginalName();
    $image->move(public_path('event/blog'), $imageName);
    $featuredImagePath = 'event/blog/' . $imageName;

    // Additional images
    $additionalImages = [];
    if ($request->hasFile('additional_images')) {
        foreach ($request->file('additional_images') as $img) {
            $imgName = time() . '_' . $img->getClientOriginalName();
            $img->move(public_path('event/blog'), $imgName);
            $additionalImages[] = 'event/blog/' . $imgName;
        }
    }

    BlogPost::create([
        'title' => $validated['title'],
        'slug' => Str::slug($validated['title']),
        'content' => $validated['content'],
        'excerpt' => $validated['excerpt'],
        'featured_image' => $featuredImagePath,
        'additional_images' => json_encode($additionalImages),
        'published_at' => $validated['published_at']
    ]);

    return redirect()->route('admin.blog.index')->with('success', 'Upcoming Events created successfully!');
}


    public function show(BlogPost $blog)
    {
        return view('admin.blog.show', compact('blog'));
    }

    public function edit(BlogPost $blog)
    {
        $categories = ['Stage Design', 'Marketing', 'Dance Techniques', 'Event Planning', 'Judging Tips'];
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

public function update(Request $request, $id)
{
    $blog = BlogPost::find($id);

    if (!$blog) {
        return redirect()->route('admin.blog.index')
            ->with('error', 'Blog post not found!');
    }

    $validated = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'excerpt' => 'required|max:300',
        'featured_image' => 'nullable|image|max:2048',
        'additional_images.*' => 'nullable|image|max:2048',
        'published_at' => 'required|date'
    ]);

    // Featured image update
    if ($request->hasFile('featured_image')) {
        if ($blog->featured_image && file_exists(public_path($blog->featured_image))) {
            unlink(public_path($blog->featured_image));
        }
        $image = $request->file('featured_image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('event/blog'), $imageName);
        $validated['featured_image'] = 'event/blog/' . $imageName;
    }

    // Additional images
    $additionalImages = json_decode($blog->additional_images, true) ?? [];
    if ($request->hasFile('additional_images')) {
        foreach ($request->file('additional_images') as $img) {
            $imgName = time() . '_' . $img->getClientOriginalName();
            $img->move(public_path('event/blog'), $imgName);
            $additionalImages[] = 'event/blog/' . $imgName;
        }
    }
    $validated['additional_images'] = json_encode($additionalImages);

    $validated['slug'] = \Str::slug($validated['title']);
    $blog->update($validated);

    return redirect()->route('admin.blog.index')->with('success', 'Upcoming Events updated successfully!');
}


    public function destroy(BlogPost $blog)
    {
        try {
            // Delete image from public folder
            if ($blog->featured_image && file_exists(public_path($blog->featured_image))) {
                unlink(public_path($blog->featured_image));
            }

            $blog->delete();

            return redirect()->route('admin.blog.index')
                   ->with('success', 'Blog post deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.blog.index')
                   ->with('error', 'Failed to delete blog post: ' . $e->getMessage());
        }
    }
}
