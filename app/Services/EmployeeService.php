<?php
/**
 * Created by PhpStorm.
 * User: sergiohenriqueoliveirasilva
 * Date: 26/05/16
 * Time: 19:14
 */

namespace CodeDelivery\Services;


use CodeDelivery\Repositories\EmployeeRepository;
use \DB;

class EmployeeService
{
    private $repository;

    public function __construct(EmployeeRepository $repository)
    {
        $this->guestRepository = $repository;
    }

    public function getEmplyeesByHotel($hotel_id)
    {

        $sql = "    
            select e.user_id, u.name, u.email, e.id
            from employees as e
            join users as u on (e.user_id = u.id and u.role='employee')
            where hotel_id = $hotel_id
            order by u.name
         ";

        $result = DB::select( DB::raw($sql)  );

        return $result;

    }




}