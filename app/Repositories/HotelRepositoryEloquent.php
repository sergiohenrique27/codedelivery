<?php

namespace CodeDelivery\Repositories;

use CodeDelivery\Presenters\HotelPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Models\Hotel;
use CodeDelivery\Validators\HotelValidator;

/**
 * Class HotelRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class HotelRepositoryEloquent extends BaseRepository implements HotelRepository
{
    protected $skipPresenter = true;
    protected $fieldSearchable = [
        'name'=>'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Hotel::class;
    }

    public function presenter()
    {
        return HotelPresenter::class;
    }
    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
