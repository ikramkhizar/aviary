<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBirdsTable extends Migration
{
    public function up()
    {
        Schema::create('user_birds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mutation_name');
            $table->string('ring_no')->nullable();
            $table->string('gender')->nullable();
            $table->string('male_parent')->nullable();
            $table->string('female_parent')->nullable();
            $table->string('cage_type')->nullable();
            $table->string('cage_no')->nullable();
            $table->date('dob')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
