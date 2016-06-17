<?php

namespace CodeDelivery\Repositories;

use CodeDelivery\Presenters\OrderPresenter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Models\Order;
use CodeDelivery\Validators\OrderValidator;

/**
 * Class OrderRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    protected $skipPresenter = true;

    public function getOrderByIdAndDeliveryman($id, $deliveryman)
    {
        $result = $this->model
            ->where('id', $id)
            ->where('user_deliveryman_id', $deliveryman)
            ->first();

        if ($result){
            //$this->skipPresenter = false;
            return $this->parserResult($result);
        }

        throw (new ModelNotFoundException())->setModel(get_class($this->model));
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
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
        return OrderPresenter::class;
    }
}
