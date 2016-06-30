<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'id',
        'name',
        'state'
    ];

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
}
