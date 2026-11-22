<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('name', 255);
            $table->enum('role', ['student', 'graduate', 'professional', 'admin'])->default('student');
            $table->text('education')->nullable();
            $table->json('skills')->nullable();
            $table->json('interests')->nullable();
            $table->text('work_experience')->nullable();
            $table->string('resume_path', 255)->nullable();
            $table->json('quiz_results')->nullable();
            $table->json('bookmarks')->nullable();
            $table->string('otp', 10)->nullable();
            $table->timestamp('otp_created_at')->nullable();
            $table->datetime('email_verified_at')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // New status column
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}