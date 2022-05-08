<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsSeenToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('is_seen')->nullable()->comment('1 means 1 artile seen');
            $table->tinyInteger('is_play')->nullable()->comment('1 means 1 game played');
            $table->timestamp('is_seen_created_at')->nullable();
            $table->timestamp('is_play_created_at')->nullable();
            
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
