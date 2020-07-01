<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\model\Order;
use App\Model\Promote;
use App\Model\PromoteLimited;
use App\Model\UserBalance;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use function GuzzleHttp\json_encode;
class cartController extends Controller
{
    //
    public function index(){
         $cart= $this->getCartSession();
         $products=$cart->getProduct();
         $balance=0;
         if(Auth::check()){
            $userId=Auth::user()->id;
            $promotion=User::where('id',$userId)->get();
            $balance=UserBalance::where('user_id',$userId)->get();
            if(count($balance)){
                $balance=$balance[0]->balance;
            }else{
                $balance=0;
            }
            if(count($promotion)){
                foreach($promotion as $p){
                    $p->promotes;
                }
                return view('product.cartList',
                [
                    "products"=>$products,
                    "cart"=>$cart,
                    "promotions"=>$promotion[0]->promotes,
                    "balance"=>$balance
               ]);
            }else{
                return view('product.cartList',
                [
                    "products"=>$products,
                    "cart"=>$cart,
                    "balance"=>$balance
               ]);
            }
        }else{
        return view('product.cartList',
                [
                    "products"=>$products,
                    "cart"=>$cart,
                    "balance"=>$balance
               ]);
    }

}
    function getCartSession(){
         $sesion = Session('cart')?Session::get('cart'):null;
         return new Cart($sesion);
    }
    public function deleteItem(Request $req,$id){
        $cart=$this->getCartSession();
        $cart->deleteItem($id);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }
    public function decrCart(Request $req, $id){
         $cart=$this->getCartSession();
         $cart->decrCart($id);
         $req->session()->put('cart',$cart);
         return redirect()->back();
    }
    public function incrCart(Request $req, $id){
        $cart=$this->getCartSession();
        $cart->incrCart($id);
        $req->session()->put('cart',$cart);
        return redirect()->back();
   }
   public function clearSession(Request $req){
          $req->session()->forget('cart');
   }
   public function order(Request $req){
         $cart=$this->getCartSession();

         $order= new Order();
         $order->user_id=$req->idUser;
         $order->address=$req->address;
         $order->phone=$req->phone;
         $order->status="order";
         $order->promote=$cart->promote;
         $order->cart=json_encode($cart->items);
         if($cart->promotionPrice==0){
            $order->totalPrice=$cart->totalPrice;
        }else{
            $order->totalPrice=$cart->promotionPrice;
        }
        if($req->method=="pnv21pay"){
            $userBalance=UserBalance::where('user_id',Auth::user()->id)->get();
            $adminBalance=UserBalance::where("user_id",1)->get();
            $adminBalance[0]->balance+=(int)$order->totalPrice;
            $userBalance[0]->balance-=(int)$order->totalPrice;
            $userBalance[0]->save();
            $adminBalance[0]->save();
            $order->payment="pnv21pay";
        }else{
            $order->payment="direct";
        }

         if($cart->promote!=""){
            $proUsed= PromoteLimited::where("user_id",Auth::user()->id)->where("promote_id",$cart->promoteId)->get();
            $proUsed[0]->used+=1;
             $proUsed[0]->save();
         }
         $order->save();
         $this->clearSession($req);
         return redirect()->back()->with('notification',"You have successfully placed an order");
   }

   public function checkPromotion(Request $req){
       $promote=Promote::where("name",$req->promote)->get();
       $cart=$this->getCartSession();
       if(count($promote)>0){
            $limit=PromoteLimited::where("user_id",Auth::user()->id)->where("promote_id",$promote[0]->id)->get();
            if($limit[0]->used==$promote[0]->limited){
                return redirect()->back()->with('error',"Promotion code: ".$req->promote." has expired!");
            }else{
                $cart->discount($promote[0]->discount);
                $cart->promote=$promote[0]->name;
                $cart->promoteId=$promote[0]->id;
                $cart->promoteValue=$promote[0]->discount;
                $req->session()->put('cart',$cart);
                // echo json_encode($this->getCartSession()->showPromotionPrice(),JSON_PRETTY_PRINT);
            }
       }else{
           $cart->promote="";
           $cart->promoteValue=-1;
           $cart->promotionPrice=0;
           $cart->promoteId=-1;
           $req->session()->put('cart',$cart);
           return redirect()->back()->with('error',"Promotion code: ".$req->promote." doesn't exits!");
       }
       return redirect("/cart");
    }

}

