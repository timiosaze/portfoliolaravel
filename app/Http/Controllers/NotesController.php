<?php

namespace App\Http\Controllers;

use App\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $notes = Notes::with('user')
                ->where('user_id', auth()->id())
                ->orderBy('updated_at', 'desc')
                ->paginate(5);

        $data = [
            'notes' => $notes,
            'name' => 'Note App'
        ];
                
        return view('notes.index')->with($data);
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
        $validator = Validator::make($request->all(), [
            'note' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect('/notes')
                    ->withErrors($validator)
                        ->withInput();
        }
        $request->request->add(['user_id' => Auth::id()]);
        Notes::create($request->all());

        return redirect('/notes')->with('success', 'Note was successfully created');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function show(Notes $notes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $notes = Notes::findOrFail($id);
        $data = [
            'notes' => $notes,
            'name' => 'Note App'
        ];
        return view('notes.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $validator = Validator::make($request->all(), [
            'note' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect('/notes')
                    ->withErrors($validator)
                        ->withInput();
        }
        $notes = Notes::findOrFail($id);
        $notes->note = $request->note;
        $notes->save();

        return redirect('/notes')->with('success', 'Note was successfully updated');
    
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
        $notes = Notes::findOrFail($id);
        if(Auth::id() != $notes->user_id){
            return redirect('/notes')->with('error', 'You are not the owner of the note');
        }
        if(Auth::id() == $notes->user_id){
            $notes->delete();
            return redirect('/notes')->with('success', 'Note was successfully deleted');
        }
    }
}
