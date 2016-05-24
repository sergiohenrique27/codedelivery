<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\CategoryRepository;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index( CategoryRepository $repository)
    {
        $categories = $repository->paginate(5);
        return view('admin.categories.index', compact('categories'));

    }
}
