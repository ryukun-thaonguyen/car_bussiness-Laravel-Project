<?php

use App\Model\Cart;
use App\model\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Session;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $sesion = Session('cart')?Session::get('cart'):[];
        $cart= new Cart($sesion);
        $order= new Order();
        $order->user_id=5;
        $order->cart=json_encode($cart->items);
        $order->address="Da Nang";
        $order->phone="0912123123";
        $order->status=false;
        $order->save();

    }
}
