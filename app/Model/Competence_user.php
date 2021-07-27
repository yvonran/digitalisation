<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Competence_user extends Model
{
    protected $fillable = ['idcompetence_user','competence''idInformation'

    ]


    public function information()
    {
    	return $this->belongsTo(Information::class);
    }

}
