<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

class OrdersController extends Controller
{
    private $repository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->repository = $orderRepository;
    }

    public function index()
    {
        $orders = $this->repository->paginate();
        return view('admin.orders.index', compact('orders'));
    }

    public function  edit($id, UserRepository $userRepository)
    {
        $list_status = [
            0 => 'Pendente',
            1 => 'A Caminho',
            2 => 'Entregue',
            3 => "Cancelado"
        ];

        $deliveryman = $userRepository->getDeliveryman();

        $order = $this->repository->find($id);
        return view('admin.orders.edit', compact('order', 'list_status', 'deliveryman'));
    }

    public function update(Request $request, $id)
    {
        $this->repository->update( $request->all(), $id);

        return redirect()->route('admin.orders.index');

    }
}
