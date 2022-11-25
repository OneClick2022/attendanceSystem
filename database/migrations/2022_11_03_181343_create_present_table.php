<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('present', function (Blueprint $table) {
            $table->id('present_id');
            $table->string('student_id');
            $table->foreign('student_id')->references('student_id')->on('student');
            $table->string('lecture_id',50);
            $table->foreign('lecture_id')->references('lecture_id')->on('lecture');
            $table->boolean('present');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('present', function (Blueprint $table){
            $table->dropForeign('present_student_id_foreign');
            $table->dropColumn('student_id');
            $table->dropForeign('present_lecture_id_foreign');
            $table->dropColumn('lecture_id');
        });


    }
};
