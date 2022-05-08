<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGameAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_game_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("session_id");
            $table->unsignedInteger('question_id'); // link to question table
            $table->unsignedInteger('option_id');
            $table->unsignedTinyInteger('correct');
            $table->unsignedTinyInteger('score');
            $table->unsignedTinyInteger('time');
            $table->unsignedTinyInteger('active');
            $table->timestamps();
            $table->index('question_id');
            $table->index('option_id');
            $table->index('active');
            $table->index('correct');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_game_answers');
    }
}
