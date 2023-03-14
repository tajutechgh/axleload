<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOverloadCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overload_cases', function (Blueprint $table) { 
            $table->increments('id');
            $table->string('user_id');
            $table->string('station_id');
            $table->string('transaction_id');
            $table->string('excess_weight_fine')->nullable();
            $table->string('excess_height_fine')->nullable();
            $table->string('avoided_weighing_fine')->nullable();
            $table->string('total_fine');
            $table->string('balance_amount')->nullable();
            $table->string('amount_paid')->nullable();
            $table->string('invoice_number');
            $table->string('payment_date');
            $table->string('action');
            $table->string('vehicle_number');
            $table->string('remarks')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('check_number')->nullable();
            $table->string('mobile_money_number')->nullable();
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
        Schema::dropIfExists('overload_cases');
    }
}
