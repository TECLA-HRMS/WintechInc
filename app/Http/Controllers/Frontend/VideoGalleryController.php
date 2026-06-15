<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoGalleryController extends Controller
{
    /**
     * Display video gallery page
     */
    public function index(Request $request)
    {
        $videos = Video::where('status', 'active') // Only active videos
                       ->orderBy('date', 'desc')
                       ->paginate(12);
        
        if ($request->ajax()) {
            return response()->json([
                'videos' => $videos->items(),
                'has_more_pages' => $videos->hasMorePages(),
                'next_page' => $videos->currentPage() + 1,
                'next_page_url' => $videos->nextPageUrl()
            ]);
        }
    
        return view('site.vedio-gallery.index', compact('videos'));
    }
    
    public function changeStatus(Video $video)
    {
        $video->status = !$video->status; // Toggle status
        $video->save();
        
        return response()->json([
            'success' => true,
            'new_status' => $video->status,
            'message' => 'Status changed successfully'
        ]);
    }

    /**
     * Display single video page
     */
    public function show($slug)
    {
        $video = Video::where('slug', $slug)->firstOrFail();
        $video->increment('views');
        
        $relatedVideos = Video::where('id', '!=', $video->id)
                            ->latest()
                            ->limit(4)
                            ->get();

        return view('site.vedio-gallery.show', compact('video', 'relatedVideos'));
    }

    /**
     * API endpoint for video gallery
     */
    public function apiIndex(Request $request)
    {
        $query = Video::query()->where('status', 'active');

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $sort = $request->sort ?? 'date';
        $direction = $request->direction ?? 'desc';
        $query->orderBy($sort, $direction);

        $videos = $query->paginate($request->perPage ?? 12);

        return response()->json([
            'success' => true,
            'videos' => $videos->items(),
            'has_more_pages' => $videos->hasMorePages(),
            'next_page' => $videos->currentPage() + 1,
            'next_page_url' => $videos->nextPageUrl(),
            'current_page' => $videos->currentPage(),
            'last_page' => $videos->lastPage()
        ]);
    }

    /**
     * API endpoint to track views
     */
    public function apiTrackView($id)
    {
        $video = Video::findOrFail($id);
        $video->increment('views');

        return response()->json([
            'success' => true,
            'views' => $video->views
        ]);
    }
}