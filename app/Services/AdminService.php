<?php
/**
 * Created by PhpStorm.
 * User: sergiohenriqueoliveirasilva
 * Date: 26/05/16
 * Time: 19:14
 */

namespace CodeDelivery\Services;


use \DB;

class AdminService
{

    public function __construct()
    {

    }

    public function getAdmins()
    {

        $sql = "    
            select e.user_id, u.name, u.email, e.id, h.name as hotel_name
            from employees as e
            join users as u on (e.user_id = u.id and u.role='admin')
            join hotels as h on (h.id = e.hotel_id)
            order by u.name
         ";

        $result = DB::select( DB::raw($sql)  );

        return $result;

    }




}