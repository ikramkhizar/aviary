<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBreedingPairsTable extends Migration
{
    public function up()
    {
        Schema::table('breeding_pairs', function (Blueprint $table) {
            $table->unsignedBigInteger('male_bird_id')->nullable();
            $table->foreign('male_bird_id', 'male_bird_fk_5791273')->references('id')->on('user_birds');
            $table->unsignedBigInteger('female_bird_id')->nullable();
            $table->foreign('female_bird_id', 'female_bird_fk_5791274')->references('id')->on('user_birds');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_5791278')->references('id')->on('users');
        });
    }
}
