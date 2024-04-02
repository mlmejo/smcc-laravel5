<?php

namespace App\Http\Controllers;

use App\Chart;
use App\Remark;
use App\Trainee;
use Illuminate\Http\Request;
use League\Csv\Reader;

class TraineeCSVController extends Controller
{
    public function store(Request $request, Chart $chart)
    {
        $request->validate([
            'document' => ['required', 'file']
        ]);

        $document = $request->file('document');
        $path = $document->getRealPath();

        $reader = Reader::createFromPath($path, 'r');
        $reader->setOffset(0);

        foreach ($reader->fetchAll() as $record) {
            $trainee = Trainee::firstOrCreate([
                'trainee_number' => $record['trainee_number'],
                'first_name' => $record['first_name'],
                'middle_initial' => $record['middle_initial'],
                'last_name' => $record['last_name'],
            ]);

            $chart->trainees()->attach($trainee);

            foreach ($chart->qualification->competencies as $competency) {
                foreach ($competency->learningOutcome as $learningOutcome) {
                    $remark = new Remark();

                    $remark->chart()->associate($chart);
                    $remark->learningOutcome()->associate($learningOutcome);
                    $remark->trainee()->associate($trainee);

                    $remark->save();
                }
            }
        }

        return back()
            ->with(
                'status',
                'Imported CSV file successfully.'
            );
    }
}
