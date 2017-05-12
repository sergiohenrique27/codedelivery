<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminCreateRequest;
use CodeDelivery\Http\Requests\HotelRequest;
use CodeDelivery\Http\Requests\UserRequest;
use CodeDelivery\Http\Requests\UserUpdateRequest;
use CodeDelivery\Models\Employee;
use CodeDelivery\Models\Hotel;
use CodeDelivery\Models\User;
use CodeDelivery\Repositories\HotelRepository;
use CodeDelivery\Repositories\HotelRepositoryEloquent;
use CodeDelivery\Services\AdminService;
use CodeDelivery\Services\HotelService;
use Illuminate\Http\Request;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\EmployeeRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\EmployeeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HotelController extends Controller
{
    private $repository;
    private $userRepository;
    private $hotelRepository;
    private $service;

    public function __construct(EmployeeRepository $repository, AdminService $service, UserRepository $userRepository,
                                HotelRepository $hotelRepository, HotelService $hotelService)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->userRepository = $userRepository;
        $this->hotelRepository = $hotelRepository;
        $this->hotelService = $hotelService;
    }

    public function index(Request $request)
    {
        $msg = (empty($request['msg']) ? '' : $request['msg']);

        $hotels = $this->hotelRepository->orderBy('name')->paginate();
        return view('superadmin.hotels.index', compact('hotels', 'msg'));
    }

    public function create()
    {
        return view('superadmin.hotels.create');
    }

    public function edit($id)
    {
        $hotel = $this->hotelRepository->find($id);
        return view('superadmin.hotels.edit', compact( 'hotel'));
    }

    public function destroy($id)
    {

    }

    public function update($id, HotelRequest $request)
    {
        $hotel = $request->all();
        $this->hotelRepository->update($hotel, $id);
        return redirect()->route('superadmin.hotels.index', ["msg=Hotel salvo com sucesso."]);
    }

    public function store(HotelRequest $request)
    {
        $hotel = $request->all();
        $this->hotelRepository->create($hotel);

        return redirect()->route('superadmin.hotels.index', ["msg=Hotel salvo com sucesso."]);

    }

}
