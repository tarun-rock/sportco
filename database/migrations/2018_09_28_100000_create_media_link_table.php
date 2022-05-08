<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_link', function (Blueprint $table) {
            $table->increments('id');
            $table->string('media_url');
            $table->tinyInteger('type');
            $table->tinyInteger('active');
            $table->timestamps();
            $table->index("media_url");
            $table->index("type");
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
        Schema::dropIfExists('media_link');
    }
}
