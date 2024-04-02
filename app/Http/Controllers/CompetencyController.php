<?php

namespace App\Http\Controllers;

use App\Competency;
use App\Qualification;
use Illuminate\Http\Request;

class CompetencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Qualification $qualification)
    {
        return view('competencies.index', [
            'qualification' => $qualification,
            'competencies' => $qualification->competencies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        Qualification $qualification
    ) {
        $request->validate([
            'title' => 'required|string',
        ]);

        $qualification
            ->competencies()
            ->create($request->only('title'));

        return redirect()
            ->route(
                'qualifications.competencies.index',
                $qualification
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Competency  $competency
     * @return \Illuminate\Http\Response
     */
    public function update(
        Request $request,
        Competency $competency
    ) {
        $request->validate([
            'title' => 'required|string',
        ]);

        $competency->update($request->only('title'));

        return redirect()
            ->route(
                'qualifications.competencies.index',
                $competency->qualification
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Competency  $competency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competency $competency)
    {
        $competency->delete();

        return back();
    }
}
