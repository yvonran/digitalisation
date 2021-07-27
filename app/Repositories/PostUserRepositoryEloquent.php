<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\Post__userRepository;
use App\Model\PostUser;
use App\Repositories\Validators\PostUserValidator;

/**
 * Class PostUserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PostUserRepositoryEloquent extends BaseRepository implements PostUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PostUser::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PostUserValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
