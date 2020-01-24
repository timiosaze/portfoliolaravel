<?php

namespace App\Http\Controllers;

use App\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MeetingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $meetings = Meeting::with('user')
                    ->where('user_id', Auth::id())
                    ->orderBy('meeting_date', 'desc')
                    ->paginate(5);
        $data = [
            'meetings' => $meetings,
            'name' => 'Meeting App'
        ];
        return view('meetings.index')->with($data);
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
                'meeting'=>'required',
                'meeting_date'=>'required'
        ]);

        if($validator->fails()){
            return redirect('/meetings')
                    ->withErrors($validator)
                    ->withInput();
        }

        $request->request->add(['user_id' => Auth::id()]);
        Meeting::create($request->all());

        return redirect('/meetings')->with('success', 'Meeting was successfully created');
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
        $the_meeting = Meeting::findOrFail($id);
        $data = [
            'the_meeting' => $the_meeting,
            'name' => 'Meeting App'
        ];
        return view('meetings.edit')->with($data);
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
                'meeting'=>'required',
                'meeting_date'=>'required'
        ]);

        if($validator->fails()){
            return redirect('/meetings')
                    ->withErrors($validator)
                    ->withInput();
        }
        $the_meeting = Meeting::findOrFail($id);
        $the_meeting->meeting = $request->meeting;
        $the_meeting->meeting_date = $request->meeting_date;
        $the_meeting->save();

        return redirect('/meetings')->with('success', 'Meeting was successfully updated');
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
        $the_meeting = Meeting::findOrFail($id);
        if(Auth::id() !== $the_meeting->user_id){
            return redirect('/meetings')->with('error', 'You are not the owner of this meeting');
        }
        if(Auth::id() === $the_meeting->user_id){
            $the_meeting->delete();
            return redirect('/meetings')->with('success', 'Meeting successfully deleted');
        }
    }
}
