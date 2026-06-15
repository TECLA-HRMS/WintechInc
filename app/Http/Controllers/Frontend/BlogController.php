<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
      $posts = BlogPost::orderBy('published_at', 'desc')->get();

        return view('site.blog.index', ['posts' => $posts]);
    }

    public function show(BlogPost $post)
    {
        return view('site.blog.show', compact('post'));
    }
}
