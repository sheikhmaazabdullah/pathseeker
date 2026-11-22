<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerRecommendationsTable extends Migration
{
    public function up()
    {
        Schema::create('career_recommendations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('career_id');
            $table->string('quiz_category', 255);
            $table->decimal('min_percentage', 5, 2);
            $table->timestamps();

            $table->foreign('career_id')->references('id')->on('careers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('career_recommendations');
    }
}