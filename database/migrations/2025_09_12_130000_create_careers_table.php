<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareersTable extends Migration
{
    public function up()
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->string('domain', 255);
            $table->decimal('salary', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->json('requirements')->nullable();
            $table->enum('demand_level', ['high', 'medium', 'low'])->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('careers');
    }
}