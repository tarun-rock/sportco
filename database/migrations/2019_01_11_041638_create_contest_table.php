<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string("description");
            $table->unsignedInteger('media_id');
            $table->timestamp('start_utc');
            $table->timestamp('end_utc');
            $table->unsignedDecimal('entry');
            $table->unsignedTinyInteger('score');
            $table->unsignedSmallInteger("total");
            $table->unsignedTinyInteger("active");
            $table->timestamps();
            $table->index("media_id");
            $table->index("active");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contest');
    }
}
