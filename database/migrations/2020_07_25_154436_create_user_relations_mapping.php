<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRelationsMapping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_relations_mapping', function (Blueprint $table) {
            $table->bigIncrements('user_relations_mapping_id');
            $table->unsignedBigInteger('relation_start');
            $table->unsignedBigInteger('relation_to');
            $table->foreign('relation_start')->references('user_id')->on('users');
            $table->foreign('relation_to')->references('user_id')->on('users');
            $table->boolean('accepted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_relations_mapping', function(Blueprint $table){
            $table->dropForeign('relation_start');
            $table->dropForeign('relation_to');
        });
        Schema::dropIfExists('user_relations_mapping');
    }
}
