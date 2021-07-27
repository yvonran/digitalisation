<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ExperienceUser.
 *
 * @package namespace App\Model;
 */
class ExperienceUser extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 
     						'idexperience_user',
     						'experience',
     						'date_debut',
     						'date_fin',
     						'idInformation'
    					];


    public function information()
    {
    	return $this->belongsTo(Information::class);
    }

}
