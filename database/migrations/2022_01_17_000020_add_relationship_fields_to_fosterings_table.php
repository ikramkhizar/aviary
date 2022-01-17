<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFosteringsTable extends Migration
{
    public function up()
    {
        Schema::table('fosterings', function (Blueprint $table) {
            $table->unsignedBigInteger('breeding_history_id')->nullable();
            $table->foreign('breeding_history_id', 'breeding_history_fk_5807427')->references('id')->on('breeding_histories');
            $table->unsignedBigInteger('pair_id')->nullable();
            $table->foreign('pair_id', 'pair_fk_5807428')->references('id')->on('breeding_pairs');
            $table->unsignedBigInteger('egg_type_id')->nullable();
            $table->foreign('egg_type_id', 'egg_type_fk_5807429')->references('id')->on('eggs');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_5807434')->references('id')->on('users');
        });
    }
}
