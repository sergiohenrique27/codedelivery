<?php
/**
 * Created by PhpStorm.
 * User: sergiohenriqueoliveirasilva
 * Date: 26/05/16
 * Time: 19:14
 */

namespace CodeDelivery\Services;


use CodeDelivery\Repositories\GuestRepository;
use \DB;

class GuestService
{
    private $guestRepository;

    public function __construct(GuestRepository $guestRepository)
    {
        $this->guestRepository = $guestRepository;
    }


    public function updateProfile($id_user, $guest)
    {
        $guestAux = $this->guestRepository->findByField('user_id', $id_user)->first();

        $guest['guest_id'] = null;
        if ($guestAux) {
            $result = $this->guestRepository->update($guest, $guestAux->id);
        } else {
            $result = $this->guestRepository->create($guest);
        }

        return $result;

    }
}