<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use App\Models\UserNotificationPreference;
use App\Models\JobFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use ZipArchive;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = Auth::user();
        $settings = $this->getUserSettings($user->id);
        $jobFunctions = JobFunction::where('status', 'active')->pluck('name');
        $notifPrefs = UserNotificationPreference::where('user_id', $user->id)->first();
        
        return view('site.settings.index', compact('user', 'settings', 'jobFunctions', 'notifPrefs'));
    }

    public function updateAccount(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'phone' => 'nullable|string|max:20',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update phone
        if ($request->filled('phone')) {
            $user->phone = $validated['phone'];
        }

        // Update password if provided
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!Hash::check($validated['current_password'], $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Account updated successfully!');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'linkedin_url' => 'nullable|url|max:255',
            'portfolio_url' => 'nullable|url|max:255',
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function updatePreferences(Request $request)
    {
        $user = Auth::user();
        
        $data = [
            'subscribe_updates' => $request->has('subscribe_updates') ? 1 : 0,
            'dark_mode' => $request->has('dark_mode') ? 1 : 0,
        ];

        $this->saveSettings($user->id, 'preferences', $data);

        return redirect()->back()->with('success', 'Preferences updated successfully!');
    }

    public function updateNotifications(Request $request)
    {
        $user = Auth::user();
        
        $data = [
            'job_alerts' => $request->has('job_alerts') ? 1 : 0,
            'application_updates' => $request->has('application_updates') ? 1 : 0,
            'profile_views' => $request->has('profile_views') ? 1 : 0,
            'marketing_emails' => $request->has('marketing_emails') ? 1 : 0,
            'browser_notifications' => $request->has('browser_notifications') ? 1 : 0,
        ];

        $this->saveSettings($user->id, 'notifications', $data);

        return redirect()->back()->with('success', 'Notification settings updated successfully!');
    }

    public function updatePrivacy(Request $request)
    {
        $user = Auth::user();
        
        $data = [
            'public_profile' => $request->has('public_profile') ? 1 : 0,
            'show_email' => $request->has('show_email') ? 1 : 0,
            'show_phone' => $request->has('show_phone') ? 1 : 0,
            'searchable' => $request->has('searchable') ? 1 : 0,
            'anonymous_mode' => $request->has('anonymous_mode') ? 1 : 0,
        ];

        $this->saveSettings($user->id, 'privacy', $data);

        return redirect()->back()->with('success', 'Privacy settings updated successfully!');
    }

    public function updateSecurity(Request $request)
    {
        $user = Auth::user();
        
        $data = [
            'login_alerts' => $request->has('login_alerts') ? 1 : 0,
            'suspicious_alerts' => $request->has('suspicious_alerts') ? 1 : 0,
        ];

        $this->saveSettings($user->id, 'security', $data);

        return redirect()->back()->with('success', 'Security settings updated successfully!');
    }

    public function updateJobPreferences(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'preferred_job_type' => 'nullable|string|max:255',
            'preferred_job_status' => 'nullable|string|max:255',
            'preferred_location' => 'nullable|string|max:255',
            'job_posted_timeframe' => 'nullable|string|max:255',
            'expected_salary_min' => 'nullable|numeric',
            'expected_salary_max' => 'nullable|numeric',
            'preferred_job_functions' => 'nullable|array',
        ]);

        $this->saveSettings($user->id, 'job', Arr::except($validated, ['preferred_job_functions']));

        // Save preferred job functions to notification preferences
        UserNotificationPreference::updateOrCreate(
            ['user_id' => $user->id],
            [
                'job_alerts_enabled' => true,
                'preferred_job_functions' => $validated['preferred_job_functions'] ?? [],
            ]
        );

        return redirect()->back()->with('success', 'Job preferences updated successfully!');
    }

    public function uploadResume(Request $request)
    {
        try {
            $user = Auth::user();
            
            $validated = $request->validate([
                'resume' => 'required|file|mimes:pdf,doc,docx|max:5120',
            ]);

            // Delete old resume if exists
            if ($user->resume && file_exists(public_path('resume/' . $user->resume))) {
                unlink(public_path('resume/' . $user->resume));
            }

            // Upload new resume
            $file = $request->file('resume');
            $filename = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('resume'), $filename);

            $user->resume = $filename;
            $user->save();

            return redirect()->back()->with('success', 'Resume uploaded successfully!');
        } catch (\Exception $e) {
            Log::error('Upload resume error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error uploading resume');
        }
    }

    public function deleteResume(Request $request)
    {
        try {
            $user = Auth::user();
            
            if ($user->resume && file_exists(public_path('resume/' . $user->resume))) {
                unlink(public_path('resume/' . $user->resume));
            }

            $user->resume = null;
            $user->save();

            return response()->json(['success' => true, 'message' => 'Resume deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting resume']);
        }
    }

    public function clearCache(Request $request)
    {
        try {
            \Artisan::call('cache:clear');
            \Artisan::call('view:clear');
            \Artisan::call('config:clear');
            \Artisan::call('route:clear');
            
            return response()->json(['success' => true, 'message' => 'Cache cleared successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error clearing cache: ' . $e->getMessage()]);
        }
    }

    public function deleteBrowsingHistory(Request $request)
    {
        try {
            session()->forget('browsing_history');
            session()->forget('recent_searches');
            session()->forget('viewed_jobs');
            
            return response()->json(['success' => true, 'message' => 'Browsing history deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting browsing history']);
        }
    }

    public function downloadData(Request $request)
    {
        try {
            $user = Auth::user();
            
            // Create temporary directory
            $tempDir = storage_path('app/temp/user_data_' . $user->id);
            if (!file_exists($tempDir)) {
                mkdir($tempDir, 0777, true);
            }

            // Generate user data JSON
            $userData = [
                'user_info' => [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'location' => $user->location,
                    'created_at' => $user->created_at,
                ],
                'settings' => $this->getUserSettings($user->id),
            ];

            // Add education if exists
            if (method_exists($user, 'educations')) {
                $userData['education'] = $user->educations()->get()->toArray();
            }

            // Add experience if exists
            if (method_exists($user, 'experiences')) {
                $userData['experience'] = $user->experiences()->get()->toArray();
            }

            // Add skills if exists
            if (method_exists($user, 'skills')) {
                $userData['skills'] = $user->skills()->get()->toArray();
            }

            // Save JSON file
            file_put_contents($tempDir . '/user_data.json', json_encode($userData, JSON_PRETTY_PRINT));

            // Create ZIP file
            $zipFile = storage_path('app/temp/user_data_' . $user->id . '.zip');
            $zip = new ZipArchive();
            
            if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
                $zip->addFile($tempDir . '/user_data.json', 'user_data.json');
                
                // Add resume if exists
                if ($user->resume && file_exists(public_path('resume/' . $user->resume))) {
                    $zip->addFile(public_path('resume/' . $user->resume), 'resume/' . $user->resume);
                }
                
                // Add profile picture if exists
                if ($user->profile_picture && file_exists(public_path('profile_pictures/' . $user->profile_picture))) {
                    $zip->addFile(public_path('profile_pictures/' . $user->profile_picture), 'profile_picture/' . $user->profile_picture);
                }
                
                $zip->close();
            }

            // Clean up temp directory
            unlink($tempDir . '/user_data.json');
            rmdir($tempDir);

            return response()->download($zipFile, 'my_data_' . date('Y-m-d') . '.zip')->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error('Download data error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error downloading data: ' . $e->getMessage());
        }
    }

    public function deleteAccount(Request $request)
    {
        try {
            $user = Auth::user();
            
            $validated = $request->validate([
                'password' => 'required|string',
                'confirmation' => 'required|in:DELETE',
            ]);

            // Verify password
            if (!Hash::check($validated['password'], $user->password)) {
                return response()->json(['success' => false, 'message' => 'Incorrect password']);
            }

            // Delete user files
            if ($user->resume && file_exists(public_path('resume/' . $user->resume))) {
                unlink(public_path('resume/' . $user->resume));
            }
            if ($user->profile_picture && file_exists(public_path('profile_pictures/' . $user->profile_picture))) {
                unlink(public_path('profile_pictures/' . $user->profile_picture));
            }

            // Delete user data
            DB::table('settings')->where('user_id', $user->id)->delete();
            
            // Delete related data if tables exist
            if (\Schema::hasTable('educations')) {
                DB::table('educations')->where('user_id', $user->id)->delete();
            }
            if (\Schema::hasTable('experiences')) {
                DB::table('experiences')->where('user_id', $user->id)->delete();
            }
            if (\Schema::hasTable('user_skills')) {
                DB::table('user_skills')->where('user_id', $user->id)->delete();
            }

            // Logout and delete user
            Auth::logout();
            $user->delete();

            return response()->json(['success' => true, 'message' => 'Account deleted successfully', 'redirect' => route('home')]);
        } catch (\Exception $e) {
            Log::error('Delete account error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error deleting account']);
        }
    }

    public function toggleDarkMode(Request $request)
    {
        try {
            $user = Auth::user();
            $darkMode = $request->input('dark_mode', false);
            
            $this->saveSettings($user->id, 'preferences', [
                'dark_mode' => $darkMode ? 1 : 0
            ]);

            return response()->json([
                'success' => true, 
                'message' => 'Dark mode ' . ($darkMode ? 'enabled' : 'disabled'),
                'dark_mode' => $darkMode
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating dark mode']);
        }
    }

    private function getUserSettings($userId)
    {
        $settings = Setting::where('user_id', $userId)->get();
        
        $result = [
            'preferences' => [
                'subscribe_updates' => false,
                'dark_mode' => false,
            ],
            'notifications' => [
                'job_alerts' => true,
                'application_updates' => true,
                'profile_views' => true,
                'marketing_emails' => false,
                'browser_notifications' => false,
            ],
            'privacy' => [
                'public_profile' => true,
                'show_email' => false,
                'show_phone' => false,
                'searchable' => true,
                'anonymous_mode' => false,
            ],
            'security' => [
                'login_alerts' => true,
                'suspicious_alerts' => true,
            ],
            'job' => [
                'preferred_job_type' => 'Full-Time',
                'preferred_job_status' => 'All Jobs',
                'preferred_location' => '',
                'job_posted_timeframe' => 'Last 7 Days',
                'expected_salary_min' => null,
                'expected_salary_max' => null,
            ]
        ];

        foreach ($settings as $setting) {
            if (isset($result[$setting->category])) {
                $value = $setting->value;
                
                // Handle boolean values
                if (in_array($setting->key, ['subscribe_updates', 'dark_mode', 'job_alerts', 'application_updates', 'profile_views', 'marketing_emails', 'browser_notifications', 'public_profile', 'show_email', 'show_phone', 'searchable', 'anonymous_mode', 'login_alerts', 'suspicious_alerts'])) {
                    $value = (bool)$value;
                }
                
                $result[$setting->category][$setting->key] = $value;
            }
        }

        return $result;
    }

    private function saveSettings($userId, $category, $data)
    {
        foreach ($data as $key => $value) {
            if ($value !== null) {
                Setting::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'category' => $category,
                        'key' => $key
                    ],
                    [
                        'value' => $value
                    ]
                );
            }
        }
    }
}
