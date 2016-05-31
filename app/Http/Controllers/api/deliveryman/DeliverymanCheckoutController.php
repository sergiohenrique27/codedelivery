<?php

namespace CodeDelivery\Http\Controllers\api\deliveryman;

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


class DeliverymanCheckoutController extends Controller
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

    public function index()
    {
        $id = Authorizer::getResourceOwnerId();
        $orders = $this->repository->skipPresenter(false)
            ->with($this->with)
            ->scopeQuery( function ($query) use($id){
                return $query->where('user_deliveryman_id', '=', $id);
            })->paginate();

        return $orders;
    }

    public function show($id)
    {
        $deliveryman = Authorizer::getResourceOwnerId();
        $o = $this->repository->getOrderByIdAndDeliveryman($id, $deliveryman);
        return $o;

    }

    public function updateStatus(Request $request, $id)
    {
        $deliveryman = Authorizer::getResourceOwnerId();
        $order = $this->orderService->updateStatus($id, $deliveryman, $request->get('status'));
        if ($order){
            return $order;
        }
        abort(400, 'Order não encontrado');

    }
}
