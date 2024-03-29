<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PriceColuctionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_coluction_table', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('userID');
            $table->string('month');
            $table->string('year');
            $table->string('date');
            $table->string('price');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
