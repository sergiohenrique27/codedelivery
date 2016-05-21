<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'cliente_id',
        'user_deliveryman_id',
        'total',
        'status'
    ];

    public function items(){
        return $this->hasMany(OrderItems::class);
    }

    public function deliveryman(){
        $this->belongsTo(User::class);
    }


}
