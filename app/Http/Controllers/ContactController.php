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
        $contacts = Contact::orderBy('id', 'desc')->where(function($query){
            if(request('company_id')){
                $query->where('company_id', request('company_id'));
            }
        })->paginate(10);

        return view('contacts.index', compact('contacts'), compact('companies'));
    }

    public function create()
    {
        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        return view('contacts.create', compact('companies'));
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
}
