<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_list', function (Blueprint $table) {
            $table->bigIncrements('api_id');
            $table->string('base');
            $table->string('uri');
            $table->unsignedBigInteger('topic_id');
            $table->foreign('topic_id')->references('topic_id')->on('topic');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('api_list', function(Blueprint $table){
            $table->dropForeign('topic_id');
        });
        Schema::dropIfExists('api_list');
    }
}
