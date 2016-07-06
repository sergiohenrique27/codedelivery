<?php

namespace CodeDelivery\Transformers;

use CodeDelivery\Models\User;
use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\Guest;

/**
 * Class GuestTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class GuestTransformer extends TransformerAbstract
{

    protected $availableIncludes = ['companions', 'user'];
    /**
     * Transform the \Guest entity
     * @param \Guest $model
     *
     * @return array
     */
    public function transform(Guest $model)
    {
        return [
            'id'         => (int) $model->id,
            'user_id'=>  $model->user_id,
            'guest_id'=>  $model->guest_id,
            'email'=> $model->email,
            'fullname'=> $model->fullname,
            'ocupation'=> $model->ocupation,
            'nacionality'=> $model->nacionality,
            'birthdate'=> $model->birthdate,
            'sex'=> $model->sex,
            'travelDocIssuingCountry'=> $model->travelDocIssuingCountry,
            'travelDocType'=> $model->travelDocType,
            'travelDocNumber'=> $model->travelDocNumber,
            'CPF'=> $model->CPF,
            'phone'=> $model->phone,
            'cellphone'=> $model->cellphone,
            'permanentAdress'=> $model->permanentAdress,
            'permanentZipcode'=> $model->permanentZipcode,
            'permanentCity'=> $model->permanentCity,
            'state'=> $model->state,
            'country'=> $model->country,
            'companyName'=> $model->companyName,
            'companyAdress'=> $model->companyAdress,
            'companyZipcode'=> $model->companyZipcode,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeCompanions(Guest $model)
    {
        if (!$model->companions){
            return null;
        }
        return $this->collection( $model->companions, new GuestTransformer() );
    }

    public function includeUser(Guest $model)
    {
        if (!$model->user){
            return null;
        }
        return $this->item( $model->user, new UserTransformer() );
    }

}
