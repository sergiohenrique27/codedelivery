<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Employee extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'user_id',
        'hotel_id'
    ];

    public function hotel(){
        return $this->belongsTo( Hotel::class );
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
