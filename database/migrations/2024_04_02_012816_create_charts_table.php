<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('qualification_id');
            $table->unsignedBigInteger('instructor_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();

            $table->foreign('qualification_id')
                ->references('id')->on('qualifications')
                ->onDelete('cascade');
            $table->foreign('instructor_id')
                ->references('id')->on('instructors')
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
        Schema::dropIfExists('charts');
    }
}
