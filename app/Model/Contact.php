<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['idcontact','phone','is_phone_active','email','is_email_active','linkedin','is_linkedin_active','portfolio','idInformation'

    ]


    public function information()
    {
    	return $this->belongsTo(Information::class);
    }


}
