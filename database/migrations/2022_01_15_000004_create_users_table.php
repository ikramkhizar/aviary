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
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('password')->nullable();
            $table->string('password_hash')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('is_profile_completed')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
