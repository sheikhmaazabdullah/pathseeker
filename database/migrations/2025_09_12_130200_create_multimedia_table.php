<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultimediaTable extends Migration
{
    public function up()
    {
        Schema::create('multimedia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->string('type', 50); // e.g., video, image, pdf
            $table->string('file_path', 255);
            $table->json('tags')->nullable();
            $table->string('category', 100)->nullable();
            $table->integer('download_count')->default(0);
            $table->decimal('avg_rating', 3, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('multimedia');
    }
}