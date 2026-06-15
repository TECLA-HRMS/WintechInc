<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\UserNotificationPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get or create notification preferences
        $preferences = UserNotificationPreference::firstOrCreate(
            ['user_id' => $user->id],
            [
                'job_alerts_enabled' => false,
                'daily_alerts' => false,
                'weekly_alerts' => false,
                'preferred_job_types' => json_encode([]),
                'preferred_locations' => json_encode([])
            ]
        );

        $notifications = $user->notifications()->orderBy('created_at', 'desc')->paginate(10);

        return view('site.Notifications.index', compact('preferences', 'notifications'));
    }

    public function updatePreferences(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'job_alerts_enabled' => 'sometimes|boolean',
            'daily_alerts' => 'sometimes|boolean',
            'weekly_alerts' => 'sometimes|boolean',
        ]);

        // Convert checkbox values to proper booleans
        $preferences = [
            'job_alerts_enabled' => $request->has('job_alerts_enabled'),
            'daily_alerts' => $request->has('daily_alerts'),
            'weekly_alerts' => $request->has('weekly_alerts'),
        ];

        try {
            DB::table('user_notification_preferences')->updateOrInsert(
                ['user_id' => $user->id],
                array_merge($preferences, [
                    'updated_at' => now(),
                    'created_at' => DB::raw('IFNULL(created_at, NOW())')
                ])
            );

            return redirect()->route('notifications.index')->with('success', 'Notification preferences updated successfully!');
            
        } catch (\Exception $e) {
            return redirect()->route('notifications.index')->with('error', 'Failed to update preferences: ' . $e->getMessage());
        }
    }

    public function markAsRead($id)
    {
        try {
            $notification = Notification::where('user_id', Auth::id())->findOrFail($id);
            $notification->update([
                'is_read' => true,
                'read_at' => now()
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function markAllAsRead()
    {
        try {
            Notification::where('user_id', Auth::id())
                ->where('is_read', false)
                ->update([
                    'is_read' => true,
                    'read_at' => now()
                ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function getUnreadCount()
    {
        $count = Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }
}