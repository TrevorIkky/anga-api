<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('subscription_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subtopic_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('subtopic_id')->references('subtopic_id')->on('subtopics');
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
        Schema::table('subscriptions', function(Blueprint $table){
            $table->dropForeign('user_id');
            $table->dropForeign('topic_id');
        });
        Schema::dropIfExists('subscriptions');
    }
}
