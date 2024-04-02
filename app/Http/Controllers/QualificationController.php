<?php

namespace App\Http\Controllers;

use App\Program;
use App\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function index(Program $program)
    {
        return view('qualifications.index', [
            'program' => $program,
            'qualifications' => $program->qualifications,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        Program $program
    ) {
        $request->validate([
            'title' => 'required|string|unique:qualifications'
        ]);

        $program
            ->qualifications()
            ->create($request->only('title'));

        return back()
            ->with(
                'status',
                'Qualification created successfully.'
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function update(
        Request $request,
        Qualification $qualification)
    {
        $request->validate([
            'title' => 'required|string|unique:qualifications'
        ]);

        $qualification->update($request->only('title'));

        return back()
            ->with(
                'status',
                'Qualification updated successfully.'
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Qualification $qualification)
    {
        $qualification->delete();
        
        return back()
            ->with(
                'status',
                'Qualification deleted successfully.'
            );
    }
}
