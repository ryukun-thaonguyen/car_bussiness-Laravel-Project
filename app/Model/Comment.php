<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function getUserName(){
        return User::find($this->user_id)->fullname;
    }
}
