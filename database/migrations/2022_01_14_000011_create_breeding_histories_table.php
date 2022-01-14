<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreedingHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('breeding_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('clutch_no')->nullable();
            $table->date('lay_date')->nullable();
            $table->date('hatch_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
