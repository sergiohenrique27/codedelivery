<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
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
