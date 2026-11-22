<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarksTable extends Migration
{
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bookmarkable_id');
            $table->string('bookmarkable_type', 255); // Polymorphic relationship (e.g., App\Models\Career, App\Models\Multimedia)
            $table->text('note')->nullable(); // Optional note for the bookmark
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // No foreign key for bookmarkable_id/bookmarkable_type as it's polymorphic
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookmarks');
    }
}