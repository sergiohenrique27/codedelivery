<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\CategoryRepository;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

class CategoriesController extends Controller
{

    private $repository;
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index( CategoryRepository $repository)
    {
        $categories = $repository->paginate();
        return view('admin.categories.index', compact('categories'));

    }

    public function create()
    {
        return view('admin.categories.create');

    }

    public function store(Requests\AdminCategoriesRequest $request)
    {
        $this->repository->create( $request->all() );
        return redirect()->route('admin.categories.index');
    }
    
    public function edit($id)
    {
        $category = $this->repository->find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Requests\AdminCategoriesRequest $request, $id)
    {
        $this->repository->update( $request->all(), $id );
        return redirect()->route('admin.categories.index');
    }
}
