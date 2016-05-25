<?php
/**
 * Created by PhpStorm.
 * User: sergiohenriqueoliveirasilva
 * Date: 25/05/16
 * Time: 10:07
 */

namespace CodeDelivery\Services;


use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Repositories\UserRepository;


class ClientServices
{
    private $clientRepository;
    private $userRepository;
    public function __construct(ClientRepository $clientRepository, UserRepository $userRepository  )
    {
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
    }

    public function update(array $data, $id)
    {
        $this->clientRepository->update( $data, $id);
        $user_id = $this->clientRepository->find($id, ['user_id'])->user_id;
        $this->userRepository->update($data['user'], $user_id);
    }

    public function create(array $data)
    {
        $data['user']['password'] = bcrypt(123456);
        $user = $this->userRepository->create($data['user']);

        $data['user_id'] = $user->id;
        $this->clientRepository->create( $data );
        
    }

}