<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/programs', 'ProgramController@index')
        ->name('programs.index');

    Route::post('/programs', 'ProgramController@store')
        ->name('programs.store');
    
    Route::patch(
        '/programs/{program}',
        'ProgramController@update'
    )->name('programs.update');

    Route::delete(
        '/programs/{program}',
        'ProgramController@destroy'
    )->name('programs.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get(
        '/program/{program}/qualifications',
        'QualificationController@index'
    )->name('programs.qualifications.index');

    Route::post(
        '/program/{program}/qualifications',
        'QualificationController@store'
    )->name('programs.qualifications.store');

    Route::patch(
        '/qualifications/{qualification}',
        'QualificationController@update'
    )->name('qualifications.update');

    Route::delete(
        '/qualifications/{qualification}',
        'QualificationController@destroy'
    )->name('qualifications.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get(
        '/qualifications/{qualification}/competencies',
        'CompetencyController@index'
    )->name('qualifications.competencies.index');

    Route::post(
        '/qualifications/{qualification}/competencies',
        'CompetencyController@store'
    )->name('qualifications.competencies.store');

    Route::patch(
        '/competencies/{competency}',
        'CompetencyController@update'
    )->name('competencies.update');

    Route::delete(
        '/competencies/{competency}',
        'CompetencyController@destroy'
    )->name('competencies.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get(
        '/qualifications/{qualification}/charts',
        'ChartController@index'
    )->name('qualifications.charts.index');

    Route::post(
        '/qualifications/{qualification}/charts',
        'ChartController@store'
    )->name('qualifications.charts.store');

    Route::get(
        '/charts/{chart}',
        'ChartController@show'
    )->name('charts.show');

    Route::patch(
        '/charts/{chart}',
        'ChartController@update'
    )->name('charts.update');

    Route::delete(
        '/charts/{chart}',
        'ChartController@destroy'
    )->name('charts.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get(
        '/competencies/{competency}/learning-outcomes',
        'LearningOutcomeController@index'
    )->name('competencies.learning-outcomes.index');

    Route::post(
        '/competencies/{competency}/learning-outcomes',
        'LearningOutcomeController@store'
    )->name('competencies.learning-outcomes.store');

    Route::patch(
        '/learning-outcomes/{learningOutcome}',
        'LearningOutcomeController@update'
    )->name('learning-outcomes.update');

    Route::delete(
        '/learning-outcomes/{learningOutcome}',
        'LearningOutcomeController@destroy'
    )->name('learning-outcomes.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get(
        '/instructors',
        'InstructorController@index'
    )->name('instructors.index');

    Route::post(
        '/instructors',
        'InstructorController@store'
    )->name('instructors.store');

    Route::patch(
        '/instructors/{instructor}',
        'InstructorController@update'
    )->name('instructors.update');

    Route::delete(
        '/instructors/{instructor}',
        'InstructorController@destroy'
    )->name('instructors.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get(
        '/trainees',
        'TraineeController@index'
    )->name('trainees.index');

    Route::post(
        '/trainees',
        'TraineeController@store'
    )->name('trainees.store');

    Route::patch(
        '/trainees/{trainee}',
        'TraineeController@update'
    )->name('trainees.update');

    Route::delete(
        '/trainees/{trainee}',
        'TraineeController@destroy'
    )->name('trainees.destroy');
});

Route::post(
    '/charts/{chart}/trainees/import',
    'Api\ChartController@show'
)->middleware('auth')->name('trainees.csv.store');

Route::get('/api/charts/{chart}', 'Api\ChartController@show');
Route::get('/api/trainees', 'Api\TraineeController@index');

Route::post('/api/charts/{chart}/trainees', 'Api\TraineeController@store');
Route::delete(
    '/api/charts/{chart}/trainees/{trainee}',
    'Api\TraineeController@destroy'
);

Route::get('/api/charts/{chart}/remarks', 'Api\RemarkController@index');
Route::patch('/api/charts/{chart}/remarks', 'Api\RemarkController@update');

require __DIR__.'./auth.php';
