<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\model\Order;
use App\Model\Promote;
use App\Model\PromoteLimited;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    //
    function index(){
        $activeUser=User::find(Auth::user()->id);
        $activeUser->balance;
        $promotion=Promote::all();
        $order=Order::all();
        $user=User::all();
        // echo "<pre>".json_encode($activeUser,JSON_PRETTY_PRINT)."</pre>";
        return view('admin.dashboard',
        [
            'newOrder'=>count($order),
            'newUser'=>count($user),
            "activeUser"=>$activeUser->balance,
            "promote"=>count($promotion)
        ]);
    }
}
