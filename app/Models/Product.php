<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        "category_id",
        "description",
        "price"
    ];

    public function category(){
        return $this->belongsTo( Category::class );
    }
}
