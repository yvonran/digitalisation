<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Poste_user extends Model
{
     protected $fillable = [ 
     						'idPoste_user',
     						'poste',
     						'date_debut',
     						'date_fin',
     						'idInformation'
    ]


    public function information()
    {
    	return $this->belongsTo(Information::class);
    }

}

