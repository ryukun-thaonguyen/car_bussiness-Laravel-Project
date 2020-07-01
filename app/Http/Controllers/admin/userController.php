<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class userController extends Controller
{
    //
    function index(){
        $users=User::select('fullname','email','role')->get();
        return view('admin.user',['users'=>$users]);
    }
}
