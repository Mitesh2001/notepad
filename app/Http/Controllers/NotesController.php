<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = NULL)
    {
        return view('notepad.notes',['content' => $id ? Notes::where('id',$id)->first() : ""]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function show(Notes $notes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function edit(Notes $notes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notes $notes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notes $notes)
    {
        //
    }

    public function saveData(Request $request)
    {
        $notes = Notes::create([
            'notes' => $request->data
        ]);
        $data = ['id' => $notes->id];
        return response()->json($data);
    }

    public function getData(Request $request)
    {
        $notes = Notes::where('id',$request->id)->first();
        $data = ['notes' => $notes->notes];
        return response()->json($data);
    }

    public function updateData(Request $request)
    {
        $notes = Notes::where('id',$request->id)->first();
        $notes->update(['notes'=>$request->data]);
        $data = ['id' => $notes->notes];
        return response()->json($data);
    }
}
