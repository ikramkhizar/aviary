<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreedingPairsTable extends Migration
{
    public function up()
    {
        Schema::create('breeding_pairs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cage_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
