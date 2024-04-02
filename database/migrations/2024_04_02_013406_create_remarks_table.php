<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remarks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('chart_id');
            $table->unsignedBigInteger('learning_outcome_id');
            $table->unsignedBigInteger('trainee_id');
            $table->boolean('completed')->default(false);
            $table->timestamps();

            $table->foreign('chart_id')
                ->references('id')->on('charts')
                ->onDelete('cascade');

            $table->foreign('learning_outcome_id')
                ->references('id')->on('learning_outcomes')
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
        Schema::dropIfExists('remarks');
    }
}
