<?php

namespace CodeDelivery\Models;

use CodeDelivery\Checkin;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'user_id',
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
        'companyZipcode'
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function guest(){
        return $this->hasOne(Guest::class, 'id', 'guest_id');
    }

    public function checkins(){
        return $this->hasMany(Checkin::class);
    }
}
