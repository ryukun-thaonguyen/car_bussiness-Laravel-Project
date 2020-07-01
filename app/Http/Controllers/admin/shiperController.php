<?php

namespace App\Http\Controllers\admin;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\model\Order;
use App\model\Product;
use Illuminate\Http\Request;

class shiperController extends Controller
{
    //
    function index(){
       $order=Order::where('status','order')->get();
       foreach($order as $o){
        $o->user;
        $cart=json_decode($o->cart);
        $o->cart=$cart;
        $products=[];
        foreach($cart as $c){
            array_push($products,Product::find($c->id));
        }
        $o->products=$products;
       }
    //    echo "<pre>".json_encode($order,JSON_PRETTY_PRINT)."</pre>";
    return view('admin.shiper.shiper',
    [
        "orders"=>$order,
        "option"=>"order"
    ]
    );
    }
    function shippingList(){
        $order=Order::where('status','shipping')->get();
        foreach($order as $o){
         $o->user;
         $cart=json_decode($o->cart);
         $o->cart=$cart;
         $products=[];
         foreach($cart as $c){
             array_push($products,Product::find($c->id));
         }
         $o->products=$products;
        }
     //    echo "<pre>".json_encode($order,JSON_PRETTY_PRINT)."</pre>";
     return view('admin.shiper.shiper',
     [
         "orders"=>$order,
         "option"=>"shipping"
     ]
     );
     }
     function shippedList(){
        $order=Order::where('status','shipped')->get();
        foreach($order as $o){
         $o->user;
         $cart=json_decode($o->cart);
         $o->cart=$cart;
         $products=[];
         foreach($cart as $c){
             array_push($products,Product::find($c->id));
         }
         $o->products=$products;
        }
     return view('admin.shiper.shiper',
     [
         "orders"=>$order,
         "option"=>"shipped"
     ]
     );
     }
    function shipping($id){
        event(new NotificationEvent($id));
        $order=Order::find($id);
        $order->status="shipping";
        $order->save();
        return redirect()->back()->with('notification',"Order successfully transitioned! go to the shipping list to see all infomation");
    }
    function shipped($id){
        $order=Order::find($id);
        $order->status="shipped";
        $order->save();
        return redirect()->back()->with('notification',"Order successfully transitioned! go to the shipped list to see all infomation");
    }
}
