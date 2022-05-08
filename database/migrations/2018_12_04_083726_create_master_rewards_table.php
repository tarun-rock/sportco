<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_rewards', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->unsignedDecimal("tokens");
            $table->unsignedTinyInteger("type")->comment(" 1 - Earn, 2 - Redeem");
            $table->unsignedTinyInteger("active");
            $table->timestamps();
            $table->index("active");
            $table->index("type");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_rewards');
    }
}
