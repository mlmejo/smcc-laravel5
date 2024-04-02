<?php

namespace App\Http\Controllers;

use App\Chart;
use App\Instructor;
use App\Qualification;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Qualification $qualification)
    {
        return view('charts.index', [
            'qualification' => $qualification,
            'instructors' => Instructor::all(),
            'charts' => $qualification->charts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Qualification $qualification)
    {
        $request->validate([
            'instructor' => 'required|string|exists:instructors,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $instructor = Instructor::find($request->instructor);

        $chart = new Chart;

        $chart->qualification()->associate($qualification);
        $chart->instructor()->associate($instructor);
        $chart->fill($request->only([
            'start_date',
            'end_date',
        ]));

        $chart->save();

        return back()
            ->with('status', 'Monitoring chart successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function show(Chart $chart)
    {
        return view('charts.show', [
            'chart' => $chart,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chart $chart)
    {
        return back()
            ->with('status', 'Monitoring chart successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chart $chart)
    {
        $chart->delete();

        return back()
            ->with('status', 'Monitoring chart deleted successfully.');
    }
}
