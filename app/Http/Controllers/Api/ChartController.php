<?php

namespace App\Http\Controllers\Api;

use App\Chart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChartController extends Controller
{
    public function show(Chart $chart)
    {
        return response()->json(
            $chart->with(
                'instructor.user',
                'qualification.competencies',
                'qualification.competencies.learningOutcomes',
                'trainees'
            )->first()
        );
    }
}
