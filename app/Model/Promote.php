<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Promote extends Model
{
    //
    public function users()
    {
        return $this->belongsToMany('App\User', 'promote_limiteds');
    }
}
