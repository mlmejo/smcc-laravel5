<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLearningOutcomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_outcomes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('competency_id');
            $table->string('description');
            $table->timestamps();

            $table->foreign('competency_id')
                ->references('id')->on('competencies')
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
        Schema::dropIfExists('learning_outcomes');
    }
}
