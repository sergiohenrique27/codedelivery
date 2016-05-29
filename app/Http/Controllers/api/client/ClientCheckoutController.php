<?php

namespace CodeDelivery\Http\Controllers\api\client;

use CodeDelivery\Models\Order;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class ClientCheckoutController extends Controller
{

    private $repository;
    private $userRepository;
    private $productRepository;
    private $orderService;

    public function __construct(
        OrderRepository  $repository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        OrderService $orderService
    )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository  ;
        $this->orderService = $orderService;
    }


    public function store(Request $request){
        $data = $request->all();
        $id = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find( $id )->client->id;
        $data['client_id'] = $clientId;
        $order = $this->orderService->create($data);

        $o = $this->repository->with('items')->find( $order->id );

        return $o;

    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find( $id )->client->id;
        $orders = $this->repository->with('items')->scopeQuery( function ($query) use($clientId){
            return $query->where('client_id', '=', $clientId);
        })->paginate();

        return $orders;
    }

    public function show($id)
    {
        $o = $this->repository->with(['items', 'client', 'cupom'])->find( $id );
        $o->items->each(function($item){
           $item->product;
        });

        return $o;

    }

}
