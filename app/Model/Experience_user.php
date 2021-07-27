<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Experience_user extends Model
{
     protected $fillable = [ 'idexperience_user','experience','date_debut','date_fin','idInformation'
    ]


    public function information()
    {
    	return $this->belongsTo(Information::class);
    }

}
