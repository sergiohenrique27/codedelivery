<?php

namespace CodeDelivery\Models;

use Carbon\Carbon;
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

    protected $dates = ['created_at', 'updated_at', 'checkin', 'checkout'];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function getPurposeOfTripAttribute($value)
    {
        switch ($value) {
            case 'T':
                return "Turismo";
                break;
            case 'N':
                return "Negócios";
                break;
            case 'C':
                return "Convenção";
                break;
            case 'O':
                return "Outros";
                break;
        }
    }

    public function setPurposeOfTripAttribute($value)
    {
        switch ($value) {
            case 'Turismo':
                $this->attributes['purposeOfTrip'] =  "T";
                break;
            case 'Negócios':
                $this->attributes['purposeOfTrip'] =  "N";
                break;
            case 'Convenção':
                $this->attributes['purposeOfTrip'] =  "C";
                break;
            case 'Outros':
                $this->attributes['purposeOfTrip'] =  "O";
                break;
        }
    }

    public function getArrivingByAttribute($value)
    {
        switch ($value) {
            case 'A':
                return "Avião";
                break;
            case 'N':
                return "Navio";
                break;
            case 'C':
                return "Automóvel";
                break;
            case 'O':
                return "Ônibus/Trem";
                break;
        }
    }

    public function setArrivingByAttribute($value)
    {
        switch ($value) {
            case 'Avião':
                $this->attributes['arrivingBy'] =  "A";
                break;
            case 'Navio':
                $this->attributes['arrivingBy'] =  "N";
                break;
            case 'Automóvel':
                $this->attributes['arrivingBy'] =  "C";
                break;
            case 'Ônibus/Trem':
                $this->attributes['arrivingBy'] =  "O";
                break;
        }
    }

    public function getCheckinAttribute($value)
    {
        if ($value) {
            return (string) Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i:s');
        }
    }

    public function setCheckinAttribute($value)
    {
        //dd($value);
        Carbon::setToStringFormat('Y-m-d H:i:s');
        $this->attributes['checkin'] = Carbon::createFromFormat('d/m/Y  H:i:s', $value);
    }

    public function getCheckoutAttribute($value)
    {
        if ($value) {
            return (string) Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i:s');
        }
    }

    public
    function setCheckoutAttribute($value)
    {
        //dd($value);
        Carbon::setToStringFormat('Y-m-d H:i:s');
        $this->attributes['checkout'] = Carbon::createFromFormat('d/m/Y  H:i:s', $value);
    }


    public
    function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public
    function guests()
    {
        return $this->belongsToMany(Guest::class, 'checkins_guests');
    }


}
