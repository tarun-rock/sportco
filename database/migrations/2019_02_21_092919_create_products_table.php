<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->text('slug');
            $table->unsignedSmallInteger('quantity');
            $table->unsignedInteger('media_id');
            $table->unsignedInteger('currency_id');
            $table->unsignedDecimal('price');
            $table->unsignedDecimal('token');
            $table->unsignedTinyInteger('type')->comment('0 - Price Only, 1 - Token Only, 2 - Token + Currency');
            $table->unsignedTinyInteger('published');
            $table->unsignedTinyInteger('active');
            $table->timestamps();
            $table->index('media_id');
            $table->index('currency_id');
            $table->index('published');
            $table->index('active');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
