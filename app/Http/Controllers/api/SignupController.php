<?php

namespace CodeDelivery\Http\Controllers\api;


use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests\SignupRequest;
use CodeDelivery\Repositories\GuestRepository;
use CodeDelivery\Repositories\UserRepository;

class SignupController extends Controller
{

    private $repository;
    private $guestRepository;

    public function __construct( UserRepository  $repository, GuestRepository $guestRepository)
    {
        $this->repository = $repository;
        $this->guestRepository = $guestRepository;
    }

    public function store(SignupRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $this->repository->create( $data );
    }
}
