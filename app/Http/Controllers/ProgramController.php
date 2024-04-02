<?php

namespace App\Http\Controllers;

use App\Instructor;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('programs.index', [
            'programs' => Program::all(),
            'instructors' => Instructor::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'instructor' => 'required|exists:instructors,id',
            'name' => 'required|string|unique:programs',
            'school_year' => 'required|string',
            'semester' => [
                'required',
                Rule::in(['1st semester', '2nd semester'])
            ]
        ]);

        $instructor = Instructor::find($request->instructor);
        $instructor
            ->programs()
            ->create($request->only('name', 'school_year', 'semester'));
        
        return redirect()
            ->route('programs.index')
            ->with('status', 'Program created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(
        Request $request,
        Program $program
    ) {
      $request->validate([
        'instructor' => 'required|exists:instructors,id',
        'name' => [
            'required',
            'string',
            Rule::unique('programs')->ignore($program)
        ]
      ]);

      $instructor = Instructor::find($request->instructor);

      $program->instructor()->associate($instructor);
      $program->name = $request->name;
      $program->save();

      return redirect()
        ->route('programs.index')
        ->with('status', 'Program updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()
            ->route('programs.index')
            ->with(
                'status',
                'Program deleted successfully'
            );
    }
}
