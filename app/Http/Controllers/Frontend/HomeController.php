<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Advertisement;
use App\Models\GeneralSetting;
use App\Models\Banner;
use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     public function index()
    {
        return view('site.home.index'); // or your correct view name
    }
    // Inside HomeController or GalleryController
public function showHomepage()
{
    $images = GalleryImage::select('title', 'event_date', 'image_path')
        ->orderBy('event_date', 'desc')
        ->paginate(12);

    $carouselImages = GalleryImage::select('image_path', 'title')
        ->orderBy('event_date', 'desc')
        ->take(5)
        ->get();

    return view('site.img_gallery.index', compact('images', 'carouselImages'));
}
}

