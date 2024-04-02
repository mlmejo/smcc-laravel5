<?php

namespace App\Http\Controllers\Api;

use App\Chart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Remark;
use App\Trainee;

class TraineeController extends Controller
{
    public function index()
    {
        $trainees = Trainee::all();

        return response()->json($trainees);
    }

    public function store(
        Request $request,
        Chart $chart
    ) {
        $request->validate([
            'trainee_id' => 'required|integer|exists:trainees,id'
        ]);

        $trainee = Trainee::find($request->trainee_id);
        $chart->trainees()->attach($request->trainee_id);

        foreach ($chart->qualification->competencies as $competency) {
            foreach ($competency->learningOutcomes as $learningOutcome) {
                $remark = new Remark();

                $remark->chart()->associate($chart);
                $remark->learningOutcome()->associate($learningOutcome);
                $remark->trainee()->associate($trainee);

                $remark->save();
            }
        }

        return back()
            ->with(
                'status',
                'Trainee added to monitoring chart.'
            );
    }

    public function destroy(Chart $chart, Trainee $trainee)
    {
        $chart->trainees()->detach($trainee->id);

        Remark::where([
            'chart_id' => $chart->id,
            'trainee_id' => $trainee->id
        ])->delete();

        return back()
            ->with(
                'status',
                'Trainee removed from monitoring chart.'
            );
    }
}
