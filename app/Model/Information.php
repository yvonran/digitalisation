<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $fillable = [

    					'idInformation',
    					'nom',
    					'prenoms',
    					'genre',
    					'type',
    					'adresse',
    					'nationnalite',
    					'cin',
    					'description',
    					'centre_interet',
    					'image',
    					'statut_information'

    ]


    public function poste_user()
    {
    	return $this->hasOne(Poste_user::class);
    }

    public function competence_user()
    {
    	return $this->hasOne(Competence_user::class);
    }


     public function experience_user()
    {
    	return $this->hasOne(Experience::class);
    }


     public function contact()
    {
    	return $this->hasOne(Contact::class);
    }


}
