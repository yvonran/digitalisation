<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\Experience_userRepository;
use App\Model\ExperienceUser;
use App\Repositories\Validators\ExperienceUserValidator;

/**
 * Class ExperienceUserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ExperienceUserRepositoryEloquent extends BaseRepository implements ExperienceUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ExperienceUser::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ExperienceUserValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
