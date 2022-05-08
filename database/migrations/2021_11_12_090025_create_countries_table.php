<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('active')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('razorpay')->default(1);
            $table->unsignedBigInteger('stripe')->default(1);
            $table->unsignedBigInteger('phonepe')->default(1);
            $table->unsignedBigInteger('paytm')->default(1);
            $table->unsignedBigInteger('googlepay')->default(1);
            $table->unsignedBigInteger('paypal')->default(0);
            $table->unsignedBigInteger('twocheckout')->default(0);
            
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
