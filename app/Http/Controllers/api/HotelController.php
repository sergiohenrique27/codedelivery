<?php

namespace CodeDelivery\Http\Controllers\api;


use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests\SignupRequest;
use CodeDelivery\Repositories\GuestRepository;
use CodeDelivery\Repositories\HotelRepository;
use CodeDelivery\Repositories\UserRepository;

class HotelController extends Controller
{

    private $repository;

    public function __construct( HotelRepository  $repository)
    {
        $this->repository = $repository;
    }

    public function getHotels()
    {
        return $this->repository->skipPresenter(false)->paginate();
    }
}
