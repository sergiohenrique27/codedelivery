<?php

namespace CodeDelivery\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class GuestCompanionIdSelectCriteria
 * @package namespace CodeDelivery\Criteria;
 */
class GuestCompanionIdSelectCriteria implements CriteriaInterface
{

    private $id;
    private $guest_id;

    public function __construct($id, $guest_id)
    {
        $this->id = $id;
        $this->guest_id = $guest_id;

    }

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('guest_id', '=', $this->guest_id)
           ->where('id', '=', $this->id);

        return $model;
    }
}
