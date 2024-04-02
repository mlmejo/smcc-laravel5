<?php

namespace App\Http\Controllers;

use App\Competency;
use App\LearningOutcome;
use Illuminate\Http\Request;

class LearningOutcomeController extends Controller
{
    public function index(Competency $competency)
    {
        return view('learning-outcomes.index', [
            'competency' => $competency,
            'qualification' => $competency->qualification,
            'learningOutcomes' => $competency->learningOutcomes,
        ]);
    }

    public function store(
        Request $request,
        Competency $competency
    ) {
        $validated = $request->validate([
            'description' => 'required|string',
        ]);

        $competency
            ->learningOutcomes()
            ->create($validated);

        return back()
            ->with(
                'status',
                'Learning outcome created successfully.'
            );
    }

    public function update(
        Request $request,
        LearningOutcome $learningOutcome
    ) {
        $validated = $request->validate([
            'description' => 'required|string',
        ]);

        $learningOutcome->update($validated);

        return back()
            ->with(
                'status',
                'Learning outcome updated successfully.'
            );
    }

    public function destroy(
        LearningOutcome $learningOutcome
    ) {
        $learningOutcome->delete();

        return back()
            ->with(
                'status',
                'Learning outcome deleted successfully.'
            );
    }
}
