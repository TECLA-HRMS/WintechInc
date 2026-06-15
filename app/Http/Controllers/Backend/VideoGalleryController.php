<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Video;
use Illuminate\Support\Str;

class VideoGalleryController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('date', 'desc')->paginate(12);
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_type' => 'required|in:upload,youtube',
        ]);

        DB::beginTransaction();
        try {
            // Store thumbnail in public folder
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('video-thumbnails'), $thumbnailName);
            $thumbnailPath = 'video-thumbnails/' . $thumbnailName;

            $videoData = [
                'title' => $request->title,
                'slug' => $this->generateSlug($request->title),
                'thumbnail_path' => $thumbnailPath,
                'video_type' => $request->video_type,
                'date' => $request->date,
                'duration' => $request->duration,
                'description' => $request->description,
                'views' => 0
            ];

            if ($request->video_type === 'upload') {
                $videoData['video_path'] = $this->storeVideoFile($request->file('video'));
                $videoData['youtube_id'] = null;
            } else {
                $videoData['youtube_id'] = $request->youtube_id;
                $videoData['video_path'] = null;
            }

            Video::create($videoData);
            DB::commit();

            return redirect()->route('admin.videos.index')
                            ->with('success', 'Video created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            if (isset($thumbnailPath)) {
                $this->deleteFileFromPublic($thumbnailPath);
            }
            if (isset($videoData['video_path'])) {
                $this->deleteFileFromPublic($videoData['video_path']);
            }

            return redirect()
                ->back()
                ->with('error', 'Error creating video: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($slug)
    {
        $video = Video::where('slug', $slug)->firstOrFail();
        $video->increment('views');

        $relatedVideos = Video::where('id', '!=', $video->id)
                            ->latest()
                            ->limit(4)
                            ->get();

        return view('videos.show', compact('video', 'relatedVideos'));
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $rules = [
            'title' => 'required|string|max:255',
            'video_type' => 'required|in:upload,youtube',
           
        ];

        if ($request->video_type === 'upload' && ($request->hasFile('video') || $video->video_type !== 'upload')) {
            $rules['video'] = 'required|mimetypes:video/mp4,video/webm,video/quicktime|max:51200';
        }

        if ($request->video_type === 'youtube') {
            $rules['youtube_id'] = 'required|string|max:255';
        }

        $request->validate($rules);

        try {
            $data = [
                'title' => $request->title,
                'slug' => $this->generateSlug($request->title, $video->id),
                'date' => $request->date,
                'duration' => $request->duration,
                'description' => $request->description,
                'video_type' => $request->video_type
            ];

            if ($request->hasFile('thumbnail')) {
                $this->deleteFileFromPublic($video->thumbnail_path);
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
                $thumbnail->move(public_path('video-thumbnails'), $thumbnailName);
                $data['thumbnail_path'] = 'video-thumbnails/' . $thumbnailName;
            }

            if ($request->video_type === 'upload') {
                if ($request->hasFile('video')) {
                    if ($video->video_path) {
                        $this->deleteFileFromPublic($video->video_path);
                    }
                    $data['video_path'] = $this->storeVideoFile($request->file('video'));
                } elseif ($video->video_type !== 'upload') {
                    return redirect()
                        ->back()
                        ->with('error', 'Please upload a video file.')
                        ->withInput();
                }
                $data['youtube_id'] = null;
            } else {
                $data['youtube_id'] = $request->youtube_id;
                if ($video->video_path) {
                    $this->deleteFileFromPublic($video->video_path);
                    $data['video_path'] = null;
                }
            }

            $video->update($data);

            return redirect()->route('admin.videos.index')
                            ->with('success', 'Video updated successfully!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error updating video: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);

        try {
            $this->deleteFileFromPublic($video->thumbnail_path);
            if ($video->video_path) {
                $this->deleteFileFromPublic($video->video_path);
            }
            $video->delete();

            return redirect()->route('admin.videos.index')
                            ->with('success', 'Video deleted successfully!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error deleting video: ' . $e->getMessage());
        }
    }

    protected function storeVideoFile($file)
    {
        $filename = 'video_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('videos'), $filename);
        return 'videos/' . $filename;
    }

    protected function generateSlug($title, $ignoreId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (Video::where('slug', $slug)
                ->when($ignoreId, function($query) use ($ignoreId) {
                    $query->where('id', '!=', $ignoreId);
                })
                ->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    protected function deleteFileFromPublic($relativePath)
    {
        $filePath = public_path($relativePath);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    public function changeStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:active,inactive'
            ]);

            $video = Video::findOrFail($id);
            $video->status = $request->status;
            $video->save();

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully',
                'new_status' => $video->status,
                'new_status_text' => ucfirst($video->status),
                'new_class' => $video->status === 'active' ? 'btn-success' : 'btn-secondary'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }
}
