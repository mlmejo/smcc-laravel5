<?php

namespace App\Http\Controllers\Api;

use App\Chart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Remark;

class RemarkController extends Controller
{
    public function index(Chart $chart)
    {
        return response()->json(
            $chart
                ->remarks()
                ->with('trainee')
                ->get()
        );
    }   

    public function update(
        Request $request,
        Chart $chart
    ) {
        $request->validate([
            'trainee_id' => 'required|exists:trainees,id',
            'learning_outcome_id' => 'required|exists:learning_outcomes,id',
        ]);

        $remark = Remark::where([
            ['chart_id', $chart->id],
            ['trainee_id', $request->trainee_id],
            ['learning_outcome', $request->learning_outcome_id]
        ])->first();

        $remark->update([
            'completed' => ! $remark->completed
        ]);

        return response()->json(
            $chart
                ->remarks()
                ->with('trainee')
                ->get()
        );
    }
}
