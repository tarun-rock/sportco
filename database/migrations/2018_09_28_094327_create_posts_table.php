<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("media_id");
            $table->string("title");
            $table->string("description");
            $table->tinyInteger("status");
            $table->integer("sports_id");
            $table->integer("category_id");
            $table->tinyInteger("type");
            $table->integer("created_by");
            $table->tinyInteger("active");
            $table->timestamps();
            $table->index("media_id");
            $table->index("category_id");
            $table->index("created_by");
            $table->index("sports_id");
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
        Schema::dropIfExists('posts');
    }
}
