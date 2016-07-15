<?php

namespace CodeDelivery\Transformers;

use CodeDelivery\Models\Hotel;
use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\Checkin;

/**
 * Class CheckinTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class CheckinTransformer extends TransformerAbstract
{

    protected $availableIncludes = ['hotel', 'guests'];
    /**
     * Transform the \Checkin entity
     * @param \Checkin $model
     *
     * @return array
     */


    public function transform(Checkin $model)
    {
        return [
            'id'         => (int) $model->id,
            'hotel_id' => $model->hotel_id,
            'arrivingFrom' => $model->arrivingFrom,
            'nextDestination' => $model->nextDestination,
            'purposeOfTrip' => $model->purposeOfTrip,
            'ArrivingBy' => $model->ArrivingBy,
            'carPlate' => $model->carPlate,
            'checkin' => $model->checkin,
            'companions' => $model->companions,
            'checkout' => $model->checkout,
            'record' => $model->record,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeHotel(Checkin $model)
    {
        if (!$model->hotel){
            return null;
        }
        return $this->item( $model->hotel, new HotelTransformer() );
    }

    public function includeGuests(Checkin $model)
    {
        if (!$model->guests){
            return null;
        }
        return $this->collection( $model->guests, new GuestTransformer() );
    }
}
