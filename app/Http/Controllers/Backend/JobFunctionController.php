<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JobFunction;
use Illuminate\Http\Request;

class JobFunctionController extends Controller
{
    public function index()
    {
        $jobFunctions = JobFunction::latest()->paginate(10);
        return view('admin.job-functions.index', compact('jobFunctions'));
    }

    public function create()
    {
        return view('admin.job-functions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:job_functions,name',
            'status' => 'required|in:active,inactive',
        ]);

        JobFunction::create($request->only('name', 'status'));

        return redirect()->route('admin.job-functions.index')->with('success', 'Job Function created successfully!');
    }

    public function edit(JobFunction $jobFunction)
    {
        return view('admin.job-functions.edit', compact('jobFunction'));
    }

    public function update(Request $request, JobFunction $jobFunction)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:job_functions,name,' . $jobFunction->id,
            'status' => 'required|in:active,inactive',
        ]);

        $jobFunction->update($request->only('name', 'status'));

        return redirect()->route('admin.job-functions.index')->with('success', 'Job Function updated successfully!');
    }

    public function destroy(JobFunction $jobFunction)
    {
        $jobFunction->delete();
        return redirect()->route('admin.job-functions.index')->with('success', 'Job Function deleted successfully!');
    }
}
