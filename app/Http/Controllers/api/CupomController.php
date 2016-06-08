<?php

namespace CodeDelivery\Http\Controllers\api;

use CodeDelivery\Models\Order;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\CupomRepository;

class CupomController extends Controller
{

    private $repository;

    public function __construct( CupomRepository  $repository)
    {
        $this->repository = $repository;
    }

    public function show($code)
    {
        return $this->repository->skipPresenter(false)->getByCode( $code );
    }


}
