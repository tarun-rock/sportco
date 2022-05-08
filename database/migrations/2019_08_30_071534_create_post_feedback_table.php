<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("post_id");
            $table->string("feedback");
            $table->unsignedTinyInteger('type')->comment('1 - Accept, 2 - Declined');
            $table->timestamps();
            $table->index("post_id");
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_feedback');
    }
}
