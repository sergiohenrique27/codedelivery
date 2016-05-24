<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\CategoryRepository;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\ProductRepository;

class ProductsController extends Controller
{

    private $repository;
    private $category;

    public function __construct(ProductRepository $repository, CategoryRepository $category)
    {
        $this->repository = $repository;
        $this->category = $category;
    }

    public function index()
    {
        $products = $this->repository->paginate();
        return view('admin.products.index', compact('products'));

    }

    public function create()
    {
        $categories = $this->category->lists('name', 'id');
        return view('admin.products.create', compact('categories'));

    }

    public function store(Requests\AdminProductRequest $request)
    {
        $this->repository->create( $request->all() );

        return redirect()->route('admin.products.index');
    }
    
    public function edit($id)
    {
        $product = $this->repository->find($id);
        $categories = $this->category->lists('name', 'id');

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Requests\AdminProductRequest $request, $id)
    {
        $this->repository->update( $request->all(), $id );
        return redirect()->route('admin.products.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.products.index');
    }
}
