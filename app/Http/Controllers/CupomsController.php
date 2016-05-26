<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\CategoryRepository;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\CupomRepository;

class CupomsController extends Controller
{

    private $repository;
    public function __construct(CupomRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index( )
    {
        $cupoms = $this->repository->paginate();
        return view('admin.cupoms.index', compact('cupoms'));

    }

    public function create()
    {
        return view('admin.cupoms.create');

    }

    public function store(Requests\AdminCupomRequest $request)
    {
        $this->repository->create( $request->all() );
        return redirect()->route('admin.cupoms.index');
    }
    
    public function edit($id)
    {
        $cupoms = $this->repository->find($id);
        return view('admin.cupoms.edit', compact('cupoms'));
    }

    public function update(Requests\AdminCupomRequest $request, $id)
    {
        $this->repository->update( $request->all(), $id );
        return redirect()->route('admin.cupoms.index');
    }
}
