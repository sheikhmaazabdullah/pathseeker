<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->string('category', 255);
            $table->string('focus_user_type', 100)->nullable()->comment('e.g., student, graduate, professional');
            $table->json('scoring_logic')->nullable()->comment('e.g., {"correct": 10, "incorrect": -2}');
            $table->timestamps();
        });

        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('quiz_id');
            $table->string('text', 255);
            $table->json('options')->comment('e.g., ["A", "B"] or ["Yes", "No"]');
            $table->string('answer', 100);
            $table->integer('weight')->default(10)->comment('Points for this question');
            $table->timestamps();

            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('quiz_questions');
        Schema::dropIfExists('quizzes');
    }
};