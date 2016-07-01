<?php

namespace CodeDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\GuestRepository;
use CodeDelivery\Models\Guest;
use CodeDelivery\Validators\GuestValidator;

/**
 * Class GuestRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class GuestRepositoryEloquent extends BaseRepository implements GuestRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Guest::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
