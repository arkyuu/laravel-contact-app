<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Company;

class ContactController extends Controller
{
    public function index()
    {
        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        $contacts = Contact::lastestFirst()->filter()->paginate(10);

        return view('contacts.index', compact('contacts'), compact('companies'));
    }

    public function create()
    {
        $contact = new Contact();
        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        return view('contacts.create', compact('companies', 'contact'));
    }

    public function show($id)
    {
        $contact = Contact::find($id);
        return view('contacts.show', compact('contact'));
    }

    public function store()
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required|exists:companies,id',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required',
        ]);

        Contact::create(request()->all());
        return redirect()->route('contacts.index')->with('message', 'Contact created successfully');
    }

    public function edit()
    {
        $contact = Contact::findOrFail(request('id'));
        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        return view('contacts.edit', compact('contact', 'companies'));
    }

    public function update()
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required|exists:companies,id',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $contact = Contact::findOrFail(request('id'));
        $contact->update(request()->all());
        return redirect()->route('contacts.index')->with('message', 'Contact updated successfully');
    }

    public function destroy()
    {
        $contact = Contact::findOrFail(request('id'));
        $contact->delete();
        return back()->with('message', 'Contact deleted successfully');
    }
}
