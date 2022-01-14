<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBreedingHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('breeding_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('egg_type_id')->nullable();
            $table->foreign('egg_type_id', 'egg_type_fk_5791490')->references('id')->on('eggs');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_5791496')->references('id')->on('users');
        });
    }
}
