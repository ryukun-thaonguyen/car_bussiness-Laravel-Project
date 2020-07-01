<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class orderListController extends Controller
{
    //
    function index(){

            $order=DB::table('orders')->
            join('users','users.id','=','orders.id_customer')
            ->join('products','products.id','=','orders.id_product')
            ->select('orders.address','products.name','products.image','products.type',
            'orders.quantity','orders.date','orders.status','products.price')
            ->where('users.gmail','=',Auth::user()->gmail)
            ->get();
            return view('product.orderList',['orders'=>$order]);

    }

    function order(Request $req){
        $id_product=$req->input('id');
        $id_customer=$req->input('idUser');
        $address=$req->input('address');
        $phone=$req->input('phone');
        $quantity=$req->input('quantity');
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $date= date("Y-m-d H:i:s");
         DB::table('orders')->insert(
             [
                 'id_product'=>$id_product,
                 'id_customer'=>$id_customer,
                 'address'=>$address,
                 'phone'=>$phone,
                 'quantity'=>$quantity,
                 'date'=>$date,
                 'status'=>0
             ]
             );
         return redirect('/product');
     }
}
