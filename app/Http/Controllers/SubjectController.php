<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Lecturer;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SubjectController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Subject::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $lecturers = Lecturer::all();
        return view('subjects.create', compact('lecturers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        $request->validate([]);
        $subject= Subject::create($request->all());
        $subject->user_id=$request->user()->id;
        $subject->save();
        return redirect()->route('subjects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $lecturers = Lecturer::all();
        return view('subjects.edit', compact('subject', 'lecturers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $subject->update($request->all());
        $subject->save();
        return redirect()->route('subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index');
    }
}
