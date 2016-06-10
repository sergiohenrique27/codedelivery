<?php

namespace CodeDelivery\Repositories;

use CodeDelivery\Presenters\UserPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Models\User;
use CodeDelivery\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    protected $skipPresenter = true;

    public function getDeliveryman()
    {
        return $this->model->where(['role' => 'deliveryman'])->lists('name', 'id');
    }

    public function presenter()
    {
        return UserPresenter::class;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
