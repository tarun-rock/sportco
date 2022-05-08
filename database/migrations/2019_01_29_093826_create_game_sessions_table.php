<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("user_id");
            $table->unsignedInteger("game_id");
            $table->unsignedTinyInteger("score");
            $table->unsignedTinyInteger("time");
            $table->unsignedTinyInteger("completed");
            $table->unsignedTinyInteger("active");
            $table->timestamps();
            $table->index("user_id");
            $table->index("game_id");
            $table->index("active");
            $table->index("completed");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_sessions');
    }
}
