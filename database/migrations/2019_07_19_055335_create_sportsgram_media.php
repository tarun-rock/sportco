<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSportsgramMedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sportsgram_media', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("post_id");
            $table->unsignedInteger("media_id");
            $table->unsignedTinyInteger("active");
            $table->index("active");
            $table->index("post_id");
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
        Schema::dropIfExists('sportsgram_media');
    }
}
