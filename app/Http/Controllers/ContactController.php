<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class ContactController extends Controller
{
    public function index()
    {
        $data = Contact::all();

        return view('admin.contact.index', compact('data'));
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required',
            'comment' => 'required'
        ]);


        Contact::create($request->all());

        return redirect()->back()->with('success', __('messages.Contact-send-success'));
    }

    public function edit(Contact $Contact)
    {

        $data = $Contact;

        return view('admin.contact.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $Contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $Contact)
    {
        $data = $Contact;
        $data->update($request->all());

        return redirect()->route('contact.index')->with('success',$data->Contact  . ' '. Lang::get('messages.edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $Contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $Contact)
    {
        $Contact->delete();

        return redirect()->route('contact.index')->with('success', Lang::get('messages.deleted'));
    }
}
