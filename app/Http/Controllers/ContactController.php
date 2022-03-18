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
        $contacts = Contact::orderBy('id', 'asc')->where(function($query){
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
        dd(request()->only('first_name', 'last_name', 'email', 'phone', 'address', 'company_id'));
    }
}
