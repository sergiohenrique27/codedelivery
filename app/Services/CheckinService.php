<?php
/**
 * Created by PhpStorm.
 * User: sergiohenriqueoliveirasilva
 * Date: 26/05/16
 * Time: 19:14
 */

namespace CodeDelivery\Services;


use CodeDelivery\Repositories\CheckinRepository;
use \DB;

class CheckinService
{
    private $checkinRepository;

    public function __construct(CheckinRepository $checkinRepository)
    {
        $this->checkinRepository = $checkinRepository;
    }

    public function storeCheckinByHotelId($checkin, $hotelid)
    {
        $checkinAux = $this->checkinRepository->getByIdAndHotelId($checkin['id'], $hotelid);
        if ($checkinAux) {
            $result = $this->checkinRepository->update($checkin, $checkin['id']);

            return $result;
        }
        return false;
    }

    public function store($user_id, $checkin)
    {
        $checkin['user_id'] = $user_id;

        if (isset($checkin['guests'])) {
            $checkin['guests'] = array_filter($checkin['guests']);
        }


        if (isset($checkin['id'])) {
            $checkinAux = $this->checkinRepository->getByIdAndUserId($checkin['id'], $checkin['user_id']);
            if ($checkinAux) {
                $result = $this->checkinRepository->update($checkin, $checkinAux->id);
                $result->guests()->sync($checkin['guests']);

                return $result;
            }
            return false;
        }

        $result = $this->checkinRepository->create($checkin);

        $result->guests()->sync($checkin['guests']);
        return $result;

    }

    public function getCheckins($status, $user_id)
    {

        $result = $this->checkinRepository->skipPresenter(false)->getCheckinsByStatusAndUserid($status, $user_id);
        return $result;

    }

    public function getCheckin($id, $user_id)
    {

        $result = $this->checkinRepository->skipPresenter(false)->getCheckinByIdAndUserid($id, $user_id);
        return $result;

    }


    public function top10($hotel_id)
    {

        $sql = "    
            select
                c.user_id, u.name, u.email, count(*) as qtd
            from
                checkins as c
                left outer join users as u on c.user_id = u.id
            where
                hotel_id = $hotel_id
                and status in ('R', 'V')
            group by
                c.user_id
            order by
                qtd desc
            limit 10
         ";

        $results = DB::select( DB::raw($sql) );
        return $results;

    }

    public function quantidade($hotel_id, $inicio, $fim)
    {

        $sql = "    
            select 
                count(*) as qtd
            from 
                checkins
            where 
                hotel_id = $hotel_id
                and status in ('R', 'V')
                and checkin >= '$inicio'
                and checkin <= '$fim'
         ";


        $result = DB::select( DB::raw($sql) );
        return $result;

    }

}