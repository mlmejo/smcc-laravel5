<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('qualification_id');
            $table->string('title');
            $table->timestamps();

            $table->foreign('qualification_id')
                ->references('id')->on('qualifications')
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
        Schema::dropIfExists('competencies');
    }
}
