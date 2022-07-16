<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contact.index')->with(compact('contacts'));
    }

    public function edit(Contact $contact)
    {
        return view('admin.contact.form')->with(compact('contact'));
    }

    public function update(Contact $contact, Request $request)
    {
        $contact->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'enquiry' => $request->enquiry,
            'reply' => $request->reply,
        ]);      
        notify()->success('Mail Send Successfully.', 'Sent');
        return redirect()->route('admin.contact.index');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        notify()->success('Contact Successfully deleted.', 'Deleted');
        return redirect()->route('admin.contact.index');
    }
}
