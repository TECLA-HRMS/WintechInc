<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProfileReportExport;

class ProfileReportController extends Controller
{
    // Show all user profiles
    public function index(Request $request)
    {
        try {
            $query = User::query();

            if ($request->filled('start_date')) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }
            if ($request->filled('end_date')) {
                $query->whereDate('created_at', '<=', $request->end_date);
            }
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%$search%")
                      ->orWhere('last_name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%");
                });
            }

            $relations = [];
            if (Schema::hasTable('educations')) $relations[] = 'educations';
            if (Schema::hasTable('experiences')) $relations[] = 'experiences';
            if (Schema::hasTable('user_skills')) $relations[] = 'skills';

            $users = $query->with($relations)->orderBy('created_at', 'desc')->paginate(10);

            return view('admin.report.profile.index', compact('users'));

        } catch (\Exception $e) {
            Log::error('Error loading profile report: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load profile report.');
        }
    }

    // Download PDF
    public function downloadPDF(Request $request)
    {
        try {
            $query = User::query();

            if ($request->filled('start_date')) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }
            if ($request->filled('end_date')) {
                $query->whereDate('created_at', '<=', $request->end_date);
            }
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%$search%")
                      ->orWhere('last_name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%");
                });
            }

            $users = $query->with(['educations', 'experiences', 'skills'])
                           ->orderBy('created_at', 'desc')
                           ->get();

            $pdf = PDF::loadView('admin.report.profile.pdf', compact('users'));
            return $pdf->download('profile_report.pdf');

        } catch (\Exception $e) {
            Log::error('Profile report PDF error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to download PDF.');
        }
    }

    // Download CSV
    public function downloadCSV(Request $request)
    {
        try {
            $filters = $request->only(['start_date', 'end_date', 'search']);
            return Excel::download(new ProfileReportExport($filters), 'profile_report.csv');

        } catch (\Exception $e) {
            Log::error('Profile report CSV error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to download CSV.');
        }
    }
}
