<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SiteInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_info_table', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('aboutMosque');
            $table->string('fb_link');
            $table->string('insta_link');
            $table->string('youtube_link');
            $table->string('savingAddress');


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
