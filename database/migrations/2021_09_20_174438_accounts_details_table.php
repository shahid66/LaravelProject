<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AccountsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_details_table', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('catagories');
            $table->string('day');
            $table->string('month');
            $table->string('year');
            $table->unsignedBigInteger('price');
            $table->string('comments');

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
