<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {

            $table->increments('idcontact');
            $table->bigInteger('phone');
            $table->boolean('is_phone_active');
            $table->string('email',100)->unique();
            $table->boolean('is_email_active');
            $table->string('linkedin',255);
            $table->boolean('is_linkedin_active');
            $table->string('portfolio',255);
            $table->integer('idInformation')->unsigned();
            $table->foreign('idInformation')->references('idInformation')->on('information');
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
        //
    }
}
