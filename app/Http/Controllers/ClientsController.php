<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Services\ClientServices;

class ClientsController extends Controller
{

    private $repository;
    private $clientServices;
    public function __construct(ClientRepository $repository, ClientServices $clientServices)
    {
        $this->repository = $repository;
        $this->clientServices = $clientServices;
    }

    public function index( )
    {
        $clients = $this->repository->paginate();
        return view('admin.clients.index', compact('clients'));

    }

    public function create()
    {
        return view('admin.clients.create');

    }

    public function store(Requests\AdminClientRequest $request)
    {
        $this->clientServices->create( $request->all() );
        return redirect()->route('admin.clients.index');
    }
    
    public function edit($id)
    {
        $client = $this->repository->find($id);
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Requests\AdminClientRequest $request, $id)
    {
        $this->clientServices->update( $request->all(), $id );
        return redirect()->route('admin.clients.index');
    }
}
