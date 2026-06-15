<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\CompanyRegistrationNotification;
use App\Mail\CompanyRegistrationConfirmation;
use App\Models\CompanyRegistration;
use App\Models\Email;

class CompanyRegistrationController extends Controller
{
    public function showForm()
    {
        return view('site.company.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'company_website' => 'nullable|url|max:255',
            'location' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'position' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:100',
            'experience' => 'nullable|string|max:100',
            'job_desc' => 'nullable|string',
            'job_brief' => 'nullable|file|mimes:pdf,doc,docx,txt|max:2048',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        $messages = [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'mobile.required' => 'The mobile number field is required.',
            'job_brief.mimes' => 'Job brief must be PDF, DOC, DOCX, or TXT.',
            'company_logo.image' => 'Company logo must be an image file.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please fix the errors below.',
                    'errors' => $validator->errors()
                ], 422);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $jobBriefPath = null;
            $companyLogoPath = null;

            // OUTSIDE PROJECT PATH
            $baseUploadPath = dirname(base_path()) . '/uploads/company';

            // Create folders if not exists
            if (!file_exists($baseUploadPath . '/job_briefs')) {
                mkdir($baseUploadPath . '/job_briefs', 0777, true);
            }

            if (!file_exists($baseUploadPath . '/logos')) {
                mkdir($baseUploadPath . '/logos', 0777, true);
            }

            // Upload Job Brief
            if ($request->hasFile('job_brief')) {

                $file = $request->file('job_brief');

                $fileName = time() . '_' . $file->getClientOriginalName();

                $file->move(
                    $baseUploadPath . '/job_briefs',
                    $fileName
                );

                $jobBriefPath = 'uploads/company/job_briefs/' . $fileName;
            }

            // Upload Company Logo
            if ($request->hasFile('company_logo')) {

                $file = $request->file('company_logo');

                $fileName = time() . '_' . $file->getClientOriginalName();

                $file->move(
                    $baseUploadPath . '/logos',
                    $fileName
                );

                $companyLogoPath = 'uploads/company/logos/' . $fileName;
            }

            // Save Database
            $contact = CompanyRegistration::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'company_name' => $request->company_name,
                'company_website' => $request->company_website,
                'location' => $request->location,
                'address' => $request->address,
                'position' => $request->position,
                'salary' => $request->salary,
                'experience' => $request->experience,
                'job_desc' => $request->job_desc,
                'job_brief_path' => $jobBriefPath,
                'company_logo_path' => $companyLogoPath,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'status' => 'new'
            ]);

            // Admin Emails
            $emails = Email::pluck('email');

            foreach ($emails as $email) {
                Mail::to($email)
                    ->send(new CompanyRegistrationNotification($contact));
            }

            // User Confirmation Mail
            Mail::to($contact->email)
                ->send(new CompanyRegistrationConfirmation($contact));

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Company registration submitted successfully! We will contact you soon.'
                ]);
            }

            return back()->with(
                'success',
                'Company registration submitted successfully! We will contact you soon.'
            );

        } catch (\Exception $e) {

            \Log::error(
                'Company registration error: ' .
                $e->getMessage()
            );

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again later.'
                ], 500);
            }

            return back()->with(
                'error',
                'Something went wrong. Please try again later.'
            );
        }
    }
}