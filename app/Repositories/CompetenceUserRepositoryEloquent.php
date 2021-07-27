<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\Competence_userRepository;
use App\Model\CompetenceUser;
use App\Repositories\Validators\CompetenceUserValidator;

/**
 * Class CompetenceUserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CompetenceUserRepositoryEloquent extends BaseRepository implements CompetenceUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CompetenceUser::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CompetenceUserValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
