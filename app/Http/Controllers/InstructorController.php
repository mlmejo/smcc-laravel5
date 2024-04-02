<?php

namespace App\Http\Controllers;

use App\Instructor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('instructors.index', [
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
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'instructor', 
        ]);

        $user->instructor()->create();

        return redirect()
            ->route('instructors.index')
            ->with(
                'status',
                 'Instructor account created successfully.'
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instructor $instructor)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique(User::class)->ignore($instructor->user)
            ]
        ]);

        $instructor->user()->update($request->all());

        return redirect()
            ->route('instructors.index')
            ->with(
                'status',
                'Instructor account updated successfully.'
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        $instructor->user->delete();

        return redirect()
            ->route('instructors.index')
            ->with(
                'status',
                'Instructor account updated successfully.'
            );
    }
}
