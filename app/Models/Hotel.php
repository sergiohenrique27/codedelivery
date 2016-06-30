<?php

namespace CodeDelivery\Models;

use CodeDelivery\Checkin;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
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
