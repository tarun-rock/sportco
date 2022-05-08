<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlrContestPrizeDistributionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plr_contest_prize_distribution', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id');
            $table->string('rank');
            $table->string('amount');
            $table->integer('start_index');
            $table->tinyInteger('count');
            $table->tinyInteger('active');
            $table->timestamps();
            $table->index('game_id');
            $table->index('start_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plr_contest_prize_distribution');
    }
}
