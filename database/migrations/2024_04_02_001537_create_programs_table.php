<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('instructor_id');
            $table->string('name')->unique();
            $table->string('school_year');
            $table->enum('semester', [
                '1st semester',
                '2nd semester',
            ]);
            $table->timestamps();

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
        Schema::dropIfExists('programs');
    }
}
