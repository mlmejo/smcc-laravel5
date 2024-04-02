<?php

namespace App\Http\Controllers;

use App\Trainee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TraineeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trainees.index', [
            'trainees' => Trainee::all(),
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
        $validated = $request->validate([
            'trainee_number' => 'required|unique:trainees',
            'first_name' => 'required|string',
            'middle_initial' => 'required|string',
            'last_name' => 'required|string',
        ]);

        Trainee::create($validated);

        return redirect()
            ->route('trainees.index')
            ->with(
                'status',
                'Trainee entry created successfully.'
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trainee $trainee)
    {
        $validated = $request->validate([
            'trainee_number' => [
                'required',
                Rule::unique(Trainee::class)->ignore($trainee)
            ],
            'first_name' => 'required|string',
            'middle_initial' => 'required|string',
            'last_name' => 'required|string'
        ]);

        $trainee->update($validated);

        return redirect()
            ->route('trainees.index')
            ->with(
                'status',
                'Trainee entry updated successfully.'
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trainee $trainee)
    {
        $trainee->delete();

        return redirect()
            ->route('trainees.index')
            ->with(
                'status',
                'Trainee entry deleted successfully.'
            );
    }
}
