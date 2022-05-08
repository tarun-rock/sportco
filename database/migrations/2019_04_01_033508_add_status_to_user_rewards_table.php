<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToUserRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_rewards', function (Blueprint $table) {
            //
            //$table->unsignedTinyInteger("status");
            $table->unsignedTinyInteger("status")->comment(" 1 - Approved, 2 - Decliend");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_rewards', function (Blueprint $table) {
            //
            $table->unsignedTinyInteger("status")->comment(" 1 - Approved, 2 - Decliend");
        });
    }
}
