<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Email;
use Illuminate\Support\Facades\Validator;

class EmailconfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
public function index()
{
    $emails = Email::latest()->paginate(10); // Fetch paginated emails
    return view('admin.email-config.index', compact('emails'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.email-config.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:emails,email',
        ];
    
        // Custom error messages
        $messages = [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
        ];
    
        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }
    
        // Save data to the emails table
        Email::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
    
        // Redirect with success message
        return redirect()->route('admin.emailconfig.index')
                         ->with('success', 'Email configuration saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    // Find the email by ID
    $email = Email::findOrFail($id);

    // Return the edit view with the email data
    return view('admin.email-config.edit', compact('email'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find the email by ID
        $email = Email::findOrFail($id);
    
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:emails,email,' . $email->id,
        ];
    
        // Custom error messages
        $messages = [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
        ];
    
        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }
    
        // Update the email
        $email->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
    
        // Redirect with success message
        return redirect()->route('admin.emailconfig.index')
                         ->with('messageType', 'success')
                         ->with('message', 'Email updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the email by ID
        $email = Email::findOrFail($id);
    
        // Delete the email
        $email->delete();
    
        // Return JSON response for AJAX requests
        return response()->json([
            'status' => 'success',
            'message' => 'Email deleted successfully!',
        ]);
    }
}