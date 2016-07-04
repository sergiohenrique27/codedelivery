<?php

namespace CodeDelivery\Http\Controllers\api\guest;

use CodeDelivery\Events\GetLocationDeliveryman;
use CodeDelivery\Models\Geo;
use CodeDelivery\Models\Guest;
use CodeDelivery\Models\Order;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\GuestRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\GuestService;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class GuestController extends Controller
{
    private $repository;
    private $service;

    public function __construct(
        GuestRepository  $repository, GuestService $service
    )
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
       /*
        $id = Authorizer::getResourceOwnerId();
        $orders = $this->repository->skipPresenter(false)
            ->with($this->with)
            ->scopeQuery( function ($query) use($id){
                return $query->where('user_deliveryman_id', '=', $id);
            })->paginate();

        return $orders;
       */
    }

    public function show($id)
    {
        /*
        $deliveryman = Authorizer::getResourceOwnerId();
        $o = $this->repository->skipPresenter(false)->getOrderByIdAndDeliveryman($id, $deliveryman);
        return $o;
*/
    }

    public function updateStatus(Request $request, $id)
    {
  /*     $deliveryman = Authorizer::getResourceOwnerId();
        return $this->orderService->updateStatus($id, $deliveryman, $request->get('status'));
  */
  }
    
    public function updateProfile(Request $request)
    {


        $user_id = Authorizer::getResourceOwnerId();
        $guest = $request->get('guest');


        return $this->service->updateProfile($user_id, $guest);
    }

}
