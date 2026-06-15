<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    /**
     * Display wishlist page
     */
   public function index()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your wishlist');
        }

        $userId = Auth::id();
        
        \Log::info("=== WISHLIST DEBUG ===");
        \Log::info("User ID: " . $userId);

        // Method 1: Using Eloquent (Recommended)
        try {
            $jobs = Wishlist::with(['job' => function($query) {
                    $query->select('id', 'job_title', 'company_name', 'company_logo', 'job_location', 'job_type', 'salary_from', 'salary_to', 'created_at');
                }])
                ->where('user_id', $userId)
                ->get()
                ->pluck('job')
                ->filter(fn ($job) => $job && strtolower($job->status ?? '') === 'open');
                
            \Log::info('Eloquent jobs count: ' . $jobs->count());
            
        } catch (\Exception $e) {
            \Log::error('Eloquent method failed: ' . $e->getMessage());
            
            // Method 2: Fallback to DB query
            $jobs = DB::table('wishlists')
                ->join('managejobs', 'wishlists.job_id', '=', 'managejobs.id')
                ->where('wishlists.user_id', $userId)
                ->whereRaw('LOWER(managejobs.status) = ?', ['open'])
                ->select('managejobs.*')
                ->get();
                
            \Log::info('DB Query jobs count: ' . $jobs->count());
        }

        // Debug: Check what's directly in wishlists table
        $directWishlist = DB::table('wishlists')
            ->where('user_id', $userId)
            ->get();
            
        \Log::info('Direct wishlist items: ', $directWishlist->toArray());
        \Log::info('Final jobs data: ', $jobs->toArray());

        return view('site.wishlist.index', compact('jobs'));
    }

public function show($id)
{
    $job = DB::table('managejobs')
        ->where('id', $id)
        ->whereRaw('LOWER(status) = ?', ['open'])
        ->first();

    if (!$job) {
        return redirect()->route('wishlist.index')->with('error', 'Job not found.');
    }

    return view('site.wishlist.show', compact('job'));
}

    /**
     * Add job to wishlist via AJAX
     */
    public function add(Request $request, $jobId)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to add jobs to wishlist',
                'redirect' => route('login')
            ], 401);
        }

        // Validate job exists
        $job = DB::table('managejobs')
            ->where('id', $jobId)
            ->whereRaw('LOWER(status) = ?', ['open'])
            ->first();
        
        if (!$job) {
            return response()->json(['error' => 'Job not found'], 404);
        }

        // Check if already in wishlist
        $existingWishlist = Wishlist::where('user_id', Auth::id())
            ->where('job_id', $jobId)
            ->first();

        if ($existingWishlist) {
            return response()->json([
                'success' => false,
                'message' => 'Job already in wishlist',
                'wishlist_count' => $this->getWishlistCount()
            ]);
        }

        // Add to wishlist
        Wishlist::create([
            'user_id' => Auth::id(),
            'job_id' => $jobId
        ]);

        \Log::info('Job added to wishlist - User: ' . Auth::id() . ', Job: ' . $jobId);

        return response()->json([
            'success' => true,
            'message' => 'Job added to wishlist',
            'wishlist_count' => $this->getWishlistCount(),
            'action' => 'added'
        ]);
    }

    /**
     * Remove job from wishlist via AJAX
     */
    public function remove(Request $request, $jobId)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to manage wishlist'
            ], 401);
        }

        // Remove from wishlist
        Wishlist::where('user_id', Auth::id())
            ->where('job_id', $jobId)
            ->delete();

        \Log::info('Job removed from wishlist - User: ' . Auth::id() . ', Job: ' . $jobId);

        return response()->json([
            'success' => true,
            'message' => 'Job removed from wishlist',
            'wishlist_count' => $this->getWishlistCount(),
            'action' => 'removed'
        ]);
    }

    /**
     * Check if job is in wishlist
     */
    public function checkStatus($jobId)
    {
        if (!Auth::check()) {
            return response()->json([
                'in_wishlist' => false,
                'wishlist_count' => 0
            ]);
        }

        $isInWishlist = Wishlist::where('user_id', Auth::id())
            ->where('job_id', $jobId)
            ->whereExists(function ($query) use ($jobId) {
                $query->select(DB::raw(1))
                    ->from('managejobs')
                    ->whereColumn('managejobs.id', 'wishlists.job_id')
                    ->where('managejobs.id', $jobId)
                    ->whereRaw('LOWER(managejobs.status) = ?', ['open']);
            })
            ->exists();

        return response()->json([
            'in_wishlist' => $isInWishlist,
            'wishlist_count' => $this->getWishlistCount()
        ]);
    }

    /**
     * Clear entire wishlist
     */
    public function clear()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to manage wishlist'
            ], 401);
        }

        // Clear all wishlist items for this user
        Wishlist::where('user_id', Auth::id())->delete();

        \Log::info('Wishlist cleared for user: ' . Auth::id());

        return response()->json([
            'success' => true,
            'message' => 'Wishlist cleared',
            'wishlist_count' => 0
        ]);
    }

    /**
     * Sync wishlist status for all jobs on page load
     */
    public function syncWishlistStatus(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => true,
                'wishlist_status' => [],
                'wishlist_count' => 0
            ]);
        }

        $jobIds = $request->input('job_ids', []);
        
        // Get all wishlisted job IDs for this user
        $wishlistedJobIds = Wishlist::where('user_id', Auth::id())
            ->whereIn('job_id', $jobIds)
            ->pluck('job_id')
            ->toArray();
        
        $status = [];
        foreach ($jobIds as $jobId) {
            $status[$jobId] = in_array($jobId, $wishlistedJobIds);
        }
        
        return response()->json([
            'success' => true,
            'wishlist_status' => $status,
            'wishlist_count' => $this->getWishlistCount()
        ]);
    }

    /**
     * Get wishlist count for current user
     */
    private function getWishlistCount()
    {
        if (!Auth::check()) {
            return 0;
        }

        return Wishlist::where('user_id', Auth::id())
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('managejobs')
                    ->whereColumn('managejobs.id', 'wishlists.job_id')
                    ->whereRaw('LOWER(managejobs.status) = ?', ['open']);
            })
            ->count();
    }
}
