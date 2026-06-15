<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
  public function index()
{
    $contacts = Contact::orderBy('created_at', 'desc')->paginate(10); // Latest enquiry first
    $totalContacts = Contact::count();
    return view('admin.contact.index', compact('contacts', 'totalContacts'));
}

    public function destroy($id)
    {
        $contact = Contact::find($id);
    
        if (!$contact) {
            return response()->json(['status' => 'error', 'message' => 'Contact not found'], 404);
        }
    
        $contact->delete();
    
        return response()->json(['status' => 'success', 'message' => 'Contact deleted successfully']);
    }
    

}
