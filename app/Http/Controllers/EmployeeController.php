<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\UserRequest;
use CodeDelivery\Http\Requests\UserUpdateRequest;
use CodeDelivery\Models\Employee;
use CodeDelivery\Models\User;
use Illuminate\Http\Request;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\EmployeeRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\EmployeeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{

    private $repository;
    private $userRepository;
    private $service;

    public function __construct(EmployeeRepository $repository, EmployeeService $service, UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $msg = (empty($request['msg']) ? '' : $request['msg']);
        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;
        $employees = $this->service->getEmplyeesByHotel($hotel_id);
        return view('admin.employees.index', compact('employees', 'msg'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        return view('admin.employees.edit', compact('user'));
    }

    public function destroy($id){

    }

    public function update($id, UserUpdateRequest $request)
    {
        $user = $request->all();
        $this->userRepository->update($user, $id);
        return redirect()->route('admin.employees.index', ["msg=Funcionário salvo com sucesso."]);
    }

    public function store(UserRequest $request)
    {
        $user = $request->all();
        $user['password'] = bcrypt('mudar123');
        $user['role'] = 'employee';

        $user = $this->userRepository->create($user);

        $hotel_id = $this->userRepository->find(Auth::user()->id)->employee->hotel_id;

        $emplooye = new Employee();
        $emplooye->user_id = $user->id;
        $emplooye->hotel_id = $hotel_id;
        $emplooye->save();

        Mail::send('emails.signup', ['user' => $user], function ($m) use ($user) {
            $m->from('contato@nextinn.com.br', 'NextInn');
            $m->to($user['email'], $user['name'])->subject('NextInn - Seja Bem-Vindo!');
        });

        return redirect()->route('admin.employees.index', ["msg=Funcionário salvo com sucesso."]);

    }

}
