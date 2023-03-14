<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransAxlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_axles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaction_id');
            $table->string('actual_weight');
            $table->string('actual_esal');
            $table->string('acceptable_weight');
            $table->string('acceptable_esal');
            $table->string('excess_weight');
            $table->string('excess_esal');
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
        Schema::dropIfExists('trans_axles');
    }
}
