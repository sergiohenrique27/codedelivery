<?php

namespace CodeDelivery\Http\Controllers\api\client;

use CodeDelivery\Models\Order;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\ProductRepository;


class ClientProductController extends Controller
{

    private $repository;

    public function __construct( ProductRepository  $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->skipPresenter(false)->all();
    }


}
