<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contest_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('question_id'); // link to question table
            $table->unsignedInteger('option_id');
            $table->unsignedTinyInteger('correct');
            $table->unsignedTinyInteger('score');
            $table->unsignedTinyInteger('time');
            $table->unsignedTinyInteger('active');
            $table->timestamps();
            $table->index('user_id');
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
        Schema::dropIfExists('user_answers');
    }
}
