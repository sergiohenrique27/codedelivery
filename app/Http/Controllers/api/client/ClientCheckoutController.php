<?php

namespace CodeDelivery\Http\Controllers\api\client;

use CodeDelivery\Models\Order;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use CodeDelivery\Http\Requests\CheckoutRequest;


class ClientCheckoutController extends Controller
{

    private $repository;
    private $userRepository;
    private $orderService;

    private $with = ['cupom', 'items', 'client'];

    public function __construct(
        OrderRepository  $repository,
        UserRepository $userRepository,
        OrderService $orderService
    )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->orderService = $orderService;
    }


    public function store(CheckoutRequest $request){

        $data = $request->all();
        $id = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find( $id )->client->id;
        $data['client_id'] = $clientId;
        $order = $this->orderService->create($data);

        return $this->repository->skipPresenter( false )
            ->with( $this->with )
            ->find( $order->id );;
    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find( $id )->client->id;
        $orders = $this->repository->skipPresenter( false )
            ->with( $this->with )
            ->scopeQuery( function ($query) use($clientId){
                return $query->where('client_id', '=', $clientId);
            })->paginate();
        return $orders;
    }

    public function show($id)
    {
        return $this->repository->skipPresenter( false )
            ->with( $this->with )
            ->find( $id );
    }

}
