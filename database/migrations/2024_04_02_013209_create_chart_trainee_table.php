<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartTraineeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_trainee', function (Blueprint $table) {
            $table->unsignedBigInteger('chart_id');
            $table->unsignedBigInteger('trainee_id');

            $table->foreign('chart_id')
                ->references('id')->on('charts')
                ->onDelete('cascade');
            $table->foreign('trainee_id')
                ->references('id')->on('trainees')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chart_trainee');
    }
}
