<?php

namespace CodeDelivery;

use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    protected $fillable = [
        'hotel_id',
        'guest_id',
        'email',
        'fullname',
        'ocupation',
        'nacionality',
        'birthdate',
        'sex',
        'travelDocIssuingCountry',
        'travelDocType',
        'travelDocNumber',
        'CPF',
        'phone',
        'cellphone',
        'permanentAdress',
        'permanentZipcode',
        'permanentCity',
        'state',
        'country',
        'companyName',
        'companyAdress',
        'companyZipcode',
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

    public function guest(){
        return $this->belongsTo(Guest::class, 'id', 'guest_id');
    }

}
