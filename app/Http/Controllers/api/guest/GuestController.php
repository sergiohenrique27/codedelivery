<?php

namespace CodeDelivery\Http\Controllers\api\guest;

use CodeDelivery\Criteria\GuestCompanionIdSelectCriteria;
use CodeDelivery\Events\GetLocationDeliveryman;
use CodeDelivery\Models\Geo;
use CodeDelivery\Models\Guest;
use CodeDelivery\Models\Order;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\GuestRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\GuestService;
use CodeDelivery\Services\OrderService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class GuestController extends Controller
{
    private $repository;
    private $service;

    public function __construct(
        GuestRepository $repository, GuestService $service
    )
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    public function cep($cep)
    {
        $ch = curl_init();
        // informar URL e outras funções ao CURL
        curl_setopt($ch, CURLOPT_URL, "https://viacep.com.br/ws/$cep/json");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Acessar a URL e retornar a saída
        $output = curl_exec($ch);
        // liberar
        curl_close($ch);
        // Substituir ‘Google’ por ‘PHP Curl’
        //$output = str_replace(‘Google’, ‘PHP Curl’, $output);
        // Imprimir a saída
        return $output;
    }

    public
    function index()
    {
        /*
         $id = Authorizer::getResourceOwnerId();
         $orders = $this->repository->skipPresenter(false)
             ->with($this->with)
             ->scopeQuery( function ($query) use($id){
                 return $query->where('user_deliveryman_id', '=', $id);
             })->paginate();

         return $orders;
        */
    }

    public
    function show($id)
    {
        /*
        $deliveryman = Authorizer::getResourceOwnerId();
        $o = $this->repository->skipPresenter(false)->getOrderByIdAndDeliveryman($id, $deliveryman);
        return $o;
    */
    }

    public
    function updateProfile(Request $request)
    {

        $user_id = Authorizer::getResourceOwnerId();
        $guest = $request->get('guest');


        return $this->service->updateProfile($user_id, $guest);
    }

    public
    function listCompanions()
    {
        $user_id = Authorizer::getResourceOwnerId();
        $guest = $this->repository->skipPresenter(false)->findByField('user_id', $user_id);

        if (!$guest['data'][0]['companions']) {
            return null;
        }
        return $guest['data'][0]['companions'];

    }

    public
    function destroyCompanion($id)
    {
        $user_id = Authorizer::getResourceOwnerId();
        $guest = $this->repository->findByField('user_id', $user_id)->first();

        $this->repository->pushCriteria(new GuestCompanionIdSelectCriteria($id, $guest['id']));
        $companion = $this->repository->all()->first();
        if ($companion) {
            $companion->delete();
            return 0;
        } else {
            abort(404);
        }
    }


    public
    function showCompanion($id)
    {
        $user_id = Authorizer::getResourceOwnerId();
        $guest = $this->repository->findByField('user_id', $user_id)->first();

        return $this->repository->getByIdAndGuestId($id, $guest['id']);

    }

    public
    function storeCompanion(Request $request)
    {
        $user_id = Authorizer::getResourceOwnerId();
        $guest = $this->repository->findByField('user_id', $user_id)->first();

        $companion = $request->get('guest');

        return $this->service->updateCompanion($guest['id'], $companion);

    }
}
