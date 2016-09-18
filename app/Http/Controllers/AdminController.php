<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminCreateRequest;
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

class AdminController extends Controller
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
        $admins = $this->service->getAdmins();
        return view('superadmin.admin.index', compact('admins', 'msg'));
    }

    public function create()
    {

        $hoteis = $this->hotelService->getHoteis();
        return view('superadmin.admin.create', compact('hoteis' , 'hoteis'));
    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        $hotel_id = $user->employee->hotel->id;

        $user->hotel_id = $hotel_id;
        $hoteis = $this->hotelService->getHoteis();
        return view('superadmin.admin.edit', compact('user', 'hoteis'));
    }

    public function destroy($id)
    {

    }

    public function update($id, UserUpdateRequest $request)
    {
        $user = $request->all();
        $updUser = $this->userRepository->update($user, $id);

        $employee = Employee::find($updUser->employee->id);
        $employee ->hotel_id =  $user['hotel_id'];
        $employee->save();

        return redirect()->route('superadmin.admin.index', ["msg=Administrador salvo com sucesso."]);
    }

    public function store(AdminCreateRequest $request)
    {
        $user = $request->all();
        $user['password'] = bcrypt('mudar123');
        $user['role'] = 'admin';

        $newuser = $this->userRepository->create($user);

        $emplooye = new Employee();
        $emplooye->user_id = $newuser->id;
        $emplooye->hotel_id = $user['hotel_id'];
        $emplooye->save();


        Mail::send('emails.signup', ['user' => $user], function ($m) use ($user) {
            $m->from('contato@nextinn.com.br', 'NextInn');
            $m->to($user['email'], $user['name'])->subject('NextInn - Seja Bem-Vindo!');
        });


        return redirect()->route('superadmin.admin.index', ["msg=Administrador salvo com sucesso."]);

    }

}
