<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("transaction_id");
            $table->string("plan_id");
            $table->string("customer_id");
            $table->unsignedBigInteger('amount');
            $table->string('currency')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('payment_status')->nullable();
            $table->integer('active')->nullable()->default(1);
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
}
