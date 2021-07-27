<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\InformationRepository;
use App\Model\Information;
use App\Repositories\Validators\InformationValidator;

/**
 * Class InformationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InformationRepositoryEloquent extends BaseRepository implements InformationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Information::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
