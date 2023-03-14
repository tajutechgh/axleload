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
            $table->integer('user_id');
            $table->integer('vehicleType_id');
            $table->integer('commodity_id');
            $table->integer('height_id');
            $table->integer('station_id');
            $table->string('vehicle_number');
            $table->string('origin');
            $table->string('invoice_number');
            $table->string('destination');
            $table->string('goods_type');
            $table->string('transaction_date');
            $table->string('transaction_time');
            $table->string('gross_actual_weight');
            $table->string('gross_excess_weight');
            $table->string('fine_amount')->nullable();
            $table->string('actual_height');
            $table->string('excess_height')->nullable();
            $table->boolean('avoided_weighing')->nullable();
            $table->string('officer_name')->nullable();
            $table->string('status')->nullable();
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
