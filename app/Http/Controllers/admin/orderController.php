<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\model\Order;
use App\model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\json_decode;

class orderController extends Controller
{
    //
    function index(){
        $orders=Order::all();
        foreach($orders as $o){
            $o->user;
            $cart=json_decode($o->cart);
            $o->cart=$cart;
            $products=[];
            foreach($cart as $c){
                array_push($products,Product::find($c->id));
            }
            $o->products=$products;
        }
        // echo "<pre>".json_encode($orders,JSON_PRETTY_PRINT)."</pre>";
        return view('admin.order',['orders'=>$orders]);
    }
}
