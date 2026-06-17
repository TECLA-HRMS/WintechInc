<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $this->authorizeActivityLogs();

        $query = DB::table('admin_activity_logs')->orderByDesc('created_at');

        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        if ($request->filled('admin')) {
            $search = $request->admin;
            $query->where(function ($q) use ($search) {
                $q->where('admin_name', 'like', "%{$search}%")
                    ->orWhere('admin_email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $logs = $query->paginate(10)->withQueryString();
        $modules = DB::table('admin_activity_logs')
            ->select('module')
            ->whereNotNull('module')
            ->distinct()
            ->orderBy('module')
            ->pluck('module');

        return view('admin.activity-logs.index', compact('logs', 'modules'));
    }

    private function authorizeActivityLogs(): void
    {
        $admin = DB::table('admins')->where('id', session('admin_id'))->first();
        $permissions = $admin && $admin->permissions ? json_decode($admin->permissions, true) : [];

        abort_unless(
            $admin && ($admin->role === 'super_admin' || in_array('activity_logs', $permissions ?? [])),
            403
        );
    }
}
