<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CompetenceUser.
 *
 * @package namespace App\Model;
 */
class CompetenceUser extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
    						'idcompetence_user',
    						'competence',
    						'idInformation'

    ];


    public function information()
    {
    	return $this->belongsTo(Information::class);
    }

}
