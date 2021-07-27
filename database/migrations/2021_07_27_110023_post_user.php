<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('post_user', function (Blueprint $table) {
            $table->increments('idPoste_user');
            $table->string('poste',45);
            $table->date('date_debut');
            $table->date('date_fin');
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
