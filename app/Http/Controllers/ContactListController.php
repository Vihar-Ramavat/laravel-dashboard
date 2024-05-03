<?php
namespace App\Http\Controllers;

use App\Models\ContactList;
use Illuminate\Http\Request;

class ContactListController extends Controller
{
    public function index()
    {
        $contacts = ContactList::get();
        return view('Contacts', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:contact_lists',
            'phone_number' => 'required',
        ]);

        ContactList::create($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact added successfully.');
    }

    public function show(ContactList $contactList)
    {
        return view('contacts.show', compact('contactList'));
    }

    public function edit(ContactList $contactList)
    {
        return view('contacts.edit', compact('contactList'));
    }

    public function update(Request $request, ContactList $contactList)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:contact_lists,email,'.$contactList->id,
            'phone_number' => 'required',
        ]);

        $contactList->update($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function destroy(ContactList $contactList)
    {
        $contactList->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
