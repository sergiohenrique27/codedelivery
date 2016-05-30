<?php
/**
 * Created by PhpStorm.
 * User: sergiohenriqueoliveirasilva
 * Date: 26/05/16
 * Time: 19:14
 */

namespace CodeDelivery\Services;


use CodeDelivery\Models\Order;
use CodeDelivery\Repositories\CupomRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use \DB;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    private $orderRepository;
    private $cupomRepository;
    private $productRepository;

    public function __construct(OrderRepository $orderRepository, CupomRepository $cupomRepository,
                                ProductRepository $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->cupomRepository = $cupomRepository;
        $this->productRepository = $productRepository;
    }

    public function getOrderByIdAndDeliveryman($id, $deliveryman)
    {
        $result = $this->orderRepository->with(['client', 'items', 'cupom'])->findWhere([
            'id' => $id,
            'user_deliveryman_id' => $deliveryman
        ]);

        $result = $result->first();
        if ($result) {
            $result->items->each(function ($item) {
                $item->product;
            });
        }
        return $result;
    }

    public function create(array $data)
    {

        \DB::beginTransaction();
        try {
            $data['status'] = 0;

            if (isset($data['cupom_code'])) {
                $cupom = $this->cupomRepository->findByField('code', $data['cupom_code'])->first();
                $data['cupom_id'] = $cupom->id;
                $cupom->used = 1;
                $cupom->save();
                unset($data['cupom_code']);
            }

            $items = $data['items'];
            unset($data['items']);

            $order = $this->orderRepository->create($data);

            $total = 0;
            foreach ($items as $item) {
                $item['price'] = $this->productRepository->find($item['product_id'])->price;
                $order->items()->create($item);
                $total += $item['price'] * $item['qtd'];
            }

            $order->total = $total;
            if (isset($cupom)) {
                $order->total = $total - $cupom->value;
            }
            $order->save();
            \DB::commit();
            return $order;
        } catch (\Exception $e) {
            \DB::roolback();
            throw $e;
        }
    }

    public function updateStatus($id, $idDeliveryMan, $status)
    {
        $order = $this->getOrderByIdAndDeliveryman($id, $idDeliveryMan);
        if ($order instanceof Order) {
            $order->status = $status;
            $order->save();
            return $order;
        }

        return false;
    }
}