<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Contact.
 *
 * @package namespace App\Model;
 */
class Contact extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'idcontact',
                            'phone',
                            'is_phone_active',
                            'email',
                            'is_email_active',
                            'linkedin',
                            'is_linkedin_active',
                            'portfolio',
                            'idInformation'

    ];


    public function information()
    {
        return $this->belongsTo(Information::class);
    }

}
