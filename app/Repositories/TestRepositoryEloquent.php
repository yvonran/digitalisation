<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\TestRepository;
use App\Model\Test;
use App\Repositories\Validators\TestValidator;

/**
 * Class TestRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TestRepositoryEloquent extends BaseRepository implements TestRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return "\App\Model\Test";
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TestValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
