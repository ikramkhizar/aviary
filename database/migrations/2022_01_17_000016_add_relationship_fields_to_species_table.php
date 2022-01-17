<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSpeciesTable extends Migration
{
    public function up()
    {
        Schema::table('species', function (Blueprint $table) {
            $table->unsignedBigInteger('bird_id')->nullable();
            $table->foreign('bird_id', 'bird_fk_5789249')->references('id')->on('birds');
        });
    }
}
