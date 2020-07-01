<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $attributes = [
        'promote' => "",
    ];
    public function user()
    {
        return $this->hasOne('App\User','id',"user_id");
    }
}
