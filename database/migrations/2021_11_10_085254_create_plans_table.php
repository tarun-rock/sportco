<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plan_name');
            $table->integer('days')->nullable();
            $table->unsignedBigInteger('amount')->nullable();
            $table->integer('active')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('currency')->nullable();
            $table->string('plan_id')->nullable();
            $table->string('stripe_plan_id')->nullable()->comment('product/subscription id from stripe account');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('plans');
    }
}
