<?php
/**
 * Created by PhpStorm.
 * User: sergiohenriqueoliveirasilva
 * Date: 26/05/16
 * Time: 19:14
 */

namespace CodeDelivery\Services;


use CodeDelivery\Repositories\HotelRepository;
use \DB;

class HotelService
{
    private $repository;

    public function __construct(HotelRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getHoteis()
    {

        $hoteis_collection = $this->repository->orderBy('name')->all(array('id', 'name'));

        $hoteis = array();
        foreach ($hoteis_collection as $hotel) {
            $hoteis[$hotel->id] = $hotel->name;
        }

        return $hoteis;

    }




}