<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFosteringsTable extends Migration
{
    public function up()
    {
        Schema::create('fosterings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('foster_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
