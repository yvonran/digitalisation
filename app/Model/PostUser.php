<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PostUser.
 *
 * @package namespace App\Model;
 */
class PostUser extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [ 
     						'idPoste_user',
     						'poste',
     						'date_debut',
     						'date_fin',
     						'idInformation'
    ];


    public function information()
    {
    	return $this->belongsTo(Information::class);
    }

}
