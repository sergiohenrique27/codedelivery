<?php

namespace CodeDelivery\Repositories;

use CodeDelivery\Presenters\CheckinPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Models\Checkin;

/**
 * Class CheckinRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class CheckinRepositoryEloquent extends BaseRepository implements CheckinRepository
{

    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Checkin::class;
    }

    public function presenter()
    {
        return CheckinPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getByIdAndUserId( $id, $user_id)
    {
        $result = $this->model
            ->where('id', $id)
            ->where('user_id', $user_id)
            ->first();

        if ($result) {
            return $this->parserResult($result);
        }

        return false;
        //throw (new ModelNotFoundException())->setModel(get_class($this->model));
    }

    public function getCheckinsByStatusAndUserid( $status, $user_id)
    {
        $result = $this->model
            ->where('status', $status)
            ->where('user_id', $user_id)
            ->paginate();

        if ($result) {
            return $this->parserResult($result);
        }

        return false;
        //throw (new ModelNotFoundException())->setModel(get_class($this->model));
    }
}
