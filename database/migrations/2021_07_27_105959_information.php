<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Information extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('information', function (Blueprint $table) {

            $table->increments('idInformation');
            $table->string('nom',45);
            $table->string('prenoms',45);
            $table->enum('genre', array('Homme', 'Femme'));
            $table->enum('type', array('Enseignant','Ancien','Etudiant'));
            $table->string('adresse',255);
            $table->enum('nationnalite', array('Malagasy', 'Etranger'));
            $table->string('cin');
            $table->text('description');
            $table->text('centre_interet');
            $table->string('image',255);
            $table->boolean('statut_information');
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
