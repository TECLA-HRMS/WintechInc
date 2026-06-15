<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\AdminSetting;
use App\Models\Contact;
use App\Mail\ContactDetailsMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $settings = AdminSetting::allDecrypted();
        return view('site.contact.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phonenumber' => 'required|string|max:20',
            'subject' => 'required|string',
            'service' => 'required|string',
            'message' => 'required|string', // Changed from description to message
        ];
    
        $validator = Validator::make($request->all(), $rules, [
            'name.required' => 'The name field is required.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }
    
        // Create contact using model
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'subject' => $request->subject,
            'service' => $request->service,
            'description' => $request->message, // Map to description field
        ]);
    
        // Get all admin emails
        $emails = DB::table('emails')->pluck('email');
    
        // Send email to each recipient
        foreach ($emails as $email) {
            Mail::to($email)->send(new ContactDetailsMail(
                $contact->name,
                $contact->email,
                $contact->phonenumber,
                $contact->subject,
                $contact->description
            ));
        }
    
        return back()->with('success', 'Your inquiry has been submitted successfully.');
    }
}