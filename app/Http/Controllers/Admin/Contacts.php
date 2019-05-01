<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Session;
use App\Http\Controllers\Controller;
use App\Data\Contact;
use Illuminate\Support\Facades\View;

class Contacts extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $contacts = Contact::all();
        $data = ['contacts' => $contacts];

        return View::make('admin/contacts/index', $data)->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // load the create form
        return View::make('admin/contacts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $rules = [
            'name'      => 'required',
            'email'     => 'required|email',
            'address'   => 'required',
        ];

        $validator = $request->validate($rules);

        // store
        $contact = new Contact();
        $contact->name      = $request->name;
        $contact->email     = $request->email;
        $contact->address   = $request->address;
        $contact->phone     = '+6281';
        $contact->save();

        // redirect
        session(['message' =>'Successfully created nerd!']);
        return redirect('/admin/contact');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Contact::where('id', $id)->first();
        return View::make('admin/contacts/show', $row)->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Contact::where('id', $id)->first();
        return View::make('admin/contacts/edit', $row)->render();
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
        $rules = [
            'id'        => 'required',
            'name'      => 'required',
            'email'     => 'required|email',
            'address'   => 'required',
        ];

        $validator = $request->validate($rules);

        $row = Contact::where('id', $request->id)->first();
        if ($row) {
            $row->name      = $request->name;
            $row->address   = $request->address;
            $row->email     = $request->email;
            $row->phone     = $request->phone;
            $row->save();
        }

        // redirect
        session(['message' =>'Contact Updated']);
        return redirect('/admin/contact');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact::destroy($id);
        return redirect('/admin/contact');
    }
}
