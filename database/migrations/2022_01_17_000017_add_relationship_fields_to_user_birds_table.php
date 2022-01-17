<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserBirdsTable extends Migration
{
    public function up()
    {
        Schema::table('user_birds', function (Blueprint $table) {
            $table->unsignedBigInteger('specie_id')->nullable();
            $table->foreign('specie_id', 'specie_fk_5791187')->references('id')->on('species');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_5791199')->references('id')->on('users');
        });
    }
}
