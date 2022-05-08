<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSportsgramTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sportsgram_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title");
            $table->unsignedDecimal("tokens");
            $table->tinyInteger('active');
            $table->timestamps();
            $table->index("title");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sportsgram_token');
    }
}
