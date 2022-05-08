<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string("transaction_id");
            $table->unsignedInteger("user_id");
            $table->unsignedInteger("wallet_id");
            $table->string("reason");
            $table->unsignedTinyInteger("status")->comment(" 1 - Approved, 2 - Decliend");
            $table->integer('active');
            $table->index("active");
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
        Schema::dropIfExists('transactions');
    }
}
