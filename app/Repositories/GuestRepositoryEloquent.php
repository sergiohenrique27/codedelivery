<?php

namespace CodeDelivery\Repositories;

use CodeDelivery\Presenters\GuestPresenter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    protected $skipPresenter = true;
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

    public function presenter()
    {
        return GuestPresenter::class;
    }

    public function getByIdAndGuestId($id, $guest_id)
    {
        $result = $this->model
            ->where('id', $id)
            ->where('guest_id', $guest_id)
            ->first();

        if ($result) {
            return $this->parserResult($result);
        }

        return false;
        //throw (new ModelNotFoundException())->setModel(get_class($this->model));
    }

}
