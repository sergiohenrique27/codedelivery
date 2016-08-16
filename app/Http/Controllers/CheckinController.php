<?php

namespace CodeDelivery\Http\Controllers;

use Carbon\Carbon;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\CheckinRepository;
use CodeDelivery\Repositories\GuestRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\CheckinService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckinController extends Controller
{
    private $repository;
    private $service;
    private $userRepository;
    private $guestRepository;

    public function __construct(
        CheckinRepository $repository, UserRepository $userRepository, CheckinService $checkinService,
        GuestRepository $guestRepository
    )
    {
        $this->repository = $repository;
        $this->service = $checkinService;
        $this->userRepository = $userRepository;
        $this->guestRepository = $guestRepository;
    }

    public function index()
    {
        return view('employee.checkin.index');
    }

    public function show(Request $request)
    {
        $id = $request->all();
        $id = $id['qrcode'];

        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;
        $checkin = $this->repository->getByIdAndHotelid($id, $hotel_id);

        return view('employee.checkin.show', compact('checkin'));
    }

    public function update($id)
    {
        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;
        $checkinAux = $this->repository->getByIdAndHotelid($id, $hotel_id);

        $purposeOfTrip['Turimos'] = 'Turismo';
        $purposeOfTrip['Negócios'] = 'Negócios';
        $purposeOfTrip['Convenção'] = 'Convenção';
        $purposeOfTrip['Outros'] = 'Outros';

        $ArrivingBy['Avião'] = 'Avião';
        $ArrivingBy['Navio'] = 'Navio';
        $ArrivingBy['Automóvel'] = 'Automóvel';
        $ArrivingBy['Ônibus/Trem'] = 'Ônibus/Trem';

        return view('employee.checkin.update', compact('checkinAux', 'purposeOfTrip', 'ArrivingBy'));
    }

    public function guest($idCheckin, $id)
    {
        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;
        $checkinAux = $this->repository->getByIdAndHotelid($id, $hotel_id);
        //todo: validar se guest esta no checkin do hotel

        $guestAux= $this->guestRepository->findByField('id', $id)->first();

       //dd($guestAux);

        return view('employee.checkin.guest', compact('guestAux', 'idCheckin'));
    }

    public function store($id, Request $request)
    {
        $checkin = $request->all();
        $checkin['id'] = $id;
        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;

        $result = $this->service->storeCheckinByHotelId($checkin, $hotel_id);
        return redirect()->route('employee.checkin.show', [$id]);

    }

    public function storeGuest($idCheckin,  $id, Request $request)
    {
        $guest = $request->all();

        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;
        $checkinAux = $this->repository->getByIdAndHotelid($idCheckin, $hotel_id);
        //todo: validar se guest esta no checkin do hotel

        $result = $this->guestRepository->update($guest, $id);

        return redirect()->route('employee.checkin.show', $idCheckin);

    }

    public function updateStatus($id,  $status)
    {
        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;
        $checkin = $this->repository->getByIdAndHotelid($id, $hotel_id);

        if($checkin) {
            $datetime = Carbon::now('America/Sao_Paulo')->format('d/m/Y  H:i:s');

            //todo: validar status anteriores
            if ($status == 'V'){
                $checkin->checkin = $datetime;
                //dd($checkin->checkin);
            }
            if ($status == 'R'){
                $checkin->checkout = $datetime;
            }
            $checkin->status = $status;
            $checkin->save();
        }
        return redirect()->route('employee.checkin.show', $id);

    }

    public function listCheckin($status)
    {
        /*
        $user_id = Authorizer::getResourceOwnerId();

        $result = $this->service->getCheckins($status, $user_id);
        return $result;
       */
    }

    public function getCheckin($id)
    {
        /*
        $user_id = Authorizer::getResourceOwnerId();

        //pegar checkin por id e hotel_id
        $result = $this->service->getCheckin($id, $user_id);
        return $result;
*/
    }
}
