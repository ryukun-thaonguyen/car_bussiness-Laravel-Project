<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\model\Product;
use App\Model\UserBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\json_decode;

class profileController extends Controller
{
    function index(){
        $user=Auth::user();
        $user->balance;
        $user->orders;
        $orders=[];
        foreach($user->orders as $o){
               $cart=json_decode($o->cart);
               $productList=[];
               $quantity=[];
               foreach($cart as $c){
                   array_push($productList,Product::find($c->id));
                   array_push($quantity,$c->quantity);
               }
               $item=[
                   "id"=>$o->id,
                   "product"=>$productList,
                   "quantity"=>$quantity,
                   "promote"=>$o->promote,
                   "address"=>$o->address,
                   "status"=>$o->status,
                   "payment"=>$o->payment,
                   "totalPrice"=>$o->totalPrice
               ];
               array_push($orders,$item);
        }
        return view("home.profile",
        [
            "user"=>$user,
            "orders"=>$orders
        ]
    );

    // echo "<pre>".json_encode($orders,JSON_PRETTY_PRINT)."</pre>";
    }
    function addMoney(Request $req){
        $userId=Auth::user()->id;
         $balance=UserBalance::where('user_id',$userId)->get();
         if(count($balance)){
            $balance[0]->user_id=$userId;
            $balance[0]->balance+=$req->balance;
            $balance[0]->save();
         }else{
            $balance=  new UserBalance();
            $balance->user_id=$userId;
            $balance->balance=$req->balance;
            $balance->save();
         }

         return redirect()->back();
    }
}
