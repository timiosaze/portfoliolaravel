<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contacts = Contact::with('user')
                    ->where('user_id', Auth::id())
                    ->orderBy('name', 'asc')
                    ->get();
        $data = [
            'contacts' => $contacts,
            'name' => 'Contact App'
        ];
        return view('contacts.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'phonenumber'=>'required|min:10',
        ]);

        if($validator->fails()){
            return redirect('/contacts')
                    ->withErrors($validator)
                    ->withInput();
        }

        $request->request->add(['user_id' => Auth::id()]);
        Contact::create($request->all());

        return redirect('/contacts')->with('success', 'Contact was successfully created');
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
        //
        $contact = Contact::findOrFail($id);
        $data = [
            'contact' => $contact,
            'name' => 'Contact App'
        ];
        return view('contacts.edit')->with($data);
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
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phonenumber' => 'required|min:10',
        ]);

        if($validator->fails()){
            return redirect('/contacts')
                ->withErrors($validator)
                ->withInput();
        }

        $contact = Contact::findOrFail($id);
        $contact->name = $request->name;
        $contact->phonenumber = $request->phonenumber;
        $contact->save();

        return redirect('/contacts')->with('success', 'Contact was successfully updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $contact = Contact::findOrFail($id);
        if(Auth::id() !== $contact->user_id){
            return redirect('/contacts')->with('error', 'You are not the owner of this contact');
        }
        if(Auth::id() === $contact->user_id){
            $contact->delete();
            return redirect('/contacts')->with('success', 'Contact was successfully deleted');
        }
    }
}
