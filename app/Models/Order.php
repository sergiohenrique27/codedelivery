<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Order extends Model implements Transformable
{
    use TransformableTrait;

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
