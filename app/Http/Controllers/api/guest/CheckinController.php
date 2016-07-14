<?php

namespace CodeDelivery\Http\Controllers\api\guest;

use CodeDelivery\Criteria\GuestCompanionIdSelectCriteria;
use CodeDelivery\Events\GetLocationDeliveryman;
use CodeDelivery\Models\Geo;
use CodeDelivery\Models\Guest;
use CodeDelivery\Models\Order;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\CheckinRepository;
use CodeDelivery\Repositories\GuestRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\CheckinService;
use CodeDelivery\Services\GuestService;
use CodeDelivery\Services\OrderService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class CheckinController extends Controller
{
    private $repository;
    private $service;

    public function __construct(
        CheckinRepository $repository, CheckinService $checkinService
    )
    {
        $this->repository = $repository;
        $this->service = $checkinService;
    }

    public function store(Request $request)
    {
        $checkin = $request->get('checkin');

        $user_id = Authorizer::getResourceOwnerId();
        $result = $this->service->store($user_id, $checkin);
        return $result;

    }

    public function listCheckin($status)
    {
        $user_id = Authorizer::getResourceOwnerId();

        $result = $this->service->getCheckins($status, $user_id);
        return $result;

    }
}
