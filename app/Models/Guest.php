<?php

namespace CodeDelivery\Models;

use Carbon\Carbon;
use CodeDelivery\Models\Checkin;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Guest extends Model implements Transformable
{
    use TransformableTrait;

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

    protected $dates = ['created_at', 'updated_at'];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function getBirthdateAttribute($value)
    {
        if ($value) {
            return (string) Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
        }
    }

    public function setBirthdateAttribute($value)
    {

        if ($value) {
            $this->attributes['birthdate'] = (string) Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        } else {
            $this->attributes['birthdate'] = null;
        }
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function companions()
    {
        return $this->hasMany(Guest::class);
    }

    public function checkins()
    {
        return $this->belongsToMany(Checkin::class, 'checkins_guests');
    }

}
