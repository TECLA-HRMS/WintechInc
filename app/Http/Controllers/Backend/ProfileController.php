<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Show all users
    public function index(Request $request)
    {
        try {
            $query = User::latest();

            if ($request->filled('search')) {
                $s = $request->search;
                $query->where(function($q) use ($s) {
                    $q->where('first_name', 'like', "%$s%")
                      ->orWhere('last_name',  'like', "%$s%")
                      ->orWhere('email',      'like', "%$s%")
                      ->orWhere('phone',      'like', "%$s%");
                });
            }

            if ($request->filled('location')) {
                $query->where('location', 'like', '%' . $request->location . '%');
            }

            if ($request->filled('gender')) {
                $query->where('gender', $request->gender);
            }

            if ($request->filled('resume')) {
                if ($request->resume === 'yes') {
                    $query->whereNotNull('resume')->where('resume', '!=', '');
                } else {
                    $query->where(function($q) {
                        $q->whereNull('resume')->orWhere('resume', '');
                    });
                }
            }

            if ($request->filled('completion')) {
                if ($request->completion === 'high') {
                    $query->where('profile_completion', '>=', 70);
                } elseif ($request->completion === 'mid') {
                    $query->whereBetween('profile_completion', [40, 69]);
                } elseif ($request->completion === 'low') {
                    $query->where('profile_completion', '<', 40);
                }
            }

            $users = $query->paginate(20)->withQueryString();

            return view('admin.profile.index', compact('users'));
        } catch (\Exception $e) {
            Log::error('Error loading user list: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load users.');
        }
    }

    // Show single user full profile
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);

            if (Schema::hasTable('educations')) $user->load('educations');
            if (Schema::hasTable('experiences')) $user->load('experiences');
            if (Schema::hasTable('user_skills')) $user->load('skills');

            return view('admin.profile.show', compact('user'));
        } catch (\Exception $e) {
            Log::error('Error showing user profile: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to load profile.');
        }
    }

    // Delete user
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to delete user.']);
        }
    }
}