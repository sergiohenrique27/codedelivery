<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Checkin extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'user_id',
        'hotel_id',
        'arrivingFrom',
        'nextDestination',
        'purposeOfTrip',
        'ArrivingBy',
        'carPlate',
        'checkin',
        'companions',
        'checkout',
        'record'
    ];

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    public  function guests(){
        return $this->belongsToMany(Guest::class, 'checkins_guests');
    }


}
