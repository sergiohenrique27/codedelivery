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

    public function show( Request $request)
    {
        $id = $request->all();
        $id = $id['qrcode'];

        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;
        $checkin = $this->repository->getByIdAndHotelid($id, $hotel_id);

        if ($checkin) {
            return view('employee.checkin.show', compact('checkin'));
        } else {
            $msg="QRCODE inválido.";
            return view('employee.checkin.index', compact('msg'));
        }
    }

    public function show2($qrcode, $msg="")
    {
        $id = $qrcode;

        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;
        $checkin = $this->repository->getByIdAndHotelid($id, $hotel_id);

        return view('employee.checkin.show', compact('checkin', 'msg'));
    }

    public function showList($id, Request $request)
    {

        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;
        $checkin = $this->repository->getByIdAndHotelid($id, $hotel_id);

        return view('employee.checkin.show', compact('checkin'));
    }

    public function ficha($id)
    {
        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;
        $checkin = $this->repository->getByIdAndHotelid($id, $hotel_id);

        return view('employee.checkin.ficha', compact('checkin'));
    }

    public function find()
    {
        // $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;
        // $checkin = $this->repository->getByIdAndHotelid($id, $hotel_id);
        $checkin = null;
        return view('employee.checkin.find', compact('checkin'));
    }

    public function doList(Request $request)
    {
        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;
        $checkin = $request->all();

        $checkins = $this->repository->doList($checkin, $hotel_id);

        return view('employee.checkin.doList', compact('checkins'));
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

        $guestAux = $this->guestRepository->findByField('id', $id)->first();

        //dd($guestAux);

        return view('employee.checkin.guest', compact('guestAux', 'idCheckin'));
    }

    public function store($id, Request $request)
    {
        $checkin = $request->all();
        $checkin['id'] = $id;
        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;

        $result = $this->service->storeCheckinByHotelId($checkin, $hotel_id);
        return redirect()->route('employee.checkin.show2', [$id, "Checkin Salvo com sucesso."]);

    }

    public function storeGuest($idCheckin, $id, Request $request)
    {
        $guest = $request->all();

        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;
        $checkinAux = $this->repository->getByIdAndHotelid($idCheckin, $hotel_id);
        //todo: validar se guest esta no checkin do hotel

        $result = $this->guestRepository->update($guest, $id);

        return redirect()->route('employee.checkin.show2', [$idCheckin, "Hospede salvo com sucesso"]);

    }

    public function updateStatus($id, $status)
    {
        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;
        $checkin = $this->repository->getByIdAndHotelid($id, $hotel_id);

        if ($checkin) {
            $datetime = Carbon::now('America/Sao_Paulo')->format('d/m/Y  H:i:s');

            //todo: validar status anteriores
            if ($status == 'V') {
                $checkin->checkin = $datetime;
                //dd($checkin->checkin);
            }
            if ($status == 'R') {
                $checkin->checkout = $datetime;
            }
            $checkin->status = $status;
            $checkin->save();
        }
        return redirect()->route('employee.checkin.show2', [$id, "Status do Checkin alterado com sucesso."]);

    }

    public function top10 ()
    {
        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;
        $results = $this->service->top10($hotel_id);
        $i = 1;

        return view('employee.checkin.top10', compact('results', 'i'));
    }

    public function findQuantidade ()
    {
        return view('employee.checkin.findQuantidade');
    }

    public function getQuantidade (Request $request)
    {

        $datas = $request->all();

        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;
        $results = $this->service->quantidade($hotel_id, $datas['inicio'], $datas['fim']);

        $inicio = $datas['inicio'];
        $fim = $datas['fim'];
        return view('employee.checkin.getQuantidade', compact('results', 'inicio', 'fim'));
    }

}
