<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Hotel extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'city_id',
        'name',
        'latitude',
        'longitude'
    ];

    public function city(){
        return $this->belongsTo( City::class );
    }

    public function employees(){
        return $this->hasMany( Employee::class );
    }

    public function checkins(){
        return $this->hasMany( Checkin::class );
    }

}
