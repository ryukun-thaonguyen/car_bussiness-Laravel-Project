<?php

namespace App\Model;

use App\model\Product;
use Illuminate\Database\Eloquent\Model;

use function GuzzleHttp\json_encode;

class Cart extends Model
{
    public $items=[];
    public $promote="";
    public $promoteId=-1;
    public $promoteValue=-1;
    public $totalPrice;
    public $promotionPrice;
    public function __construct($oldCart){
		if($oldCart){
            $this->items = $oldCart->items;
            $this->promote=$oldCart->promote;
            $this->promoteValue=$oldCart->promoteValue;
            $this->promoteId=$oldCart->promoteId;
            $this->promotionPrice=$oldCart->promotionPrice;
            $this->updateTotalPrice();
		}
    }

    public function add($id){
        $isSame=false;
        if(count($this->items)){
        foreach($this->items as $key=> $item){
            if($item['id']==$id){
                $this->items[$key]['quantity']=$item['quantity']+1;
                $isSame=true;
                break;
            }
        }
    }
    if(!$isSame){
    $item=[
        'id'=>$id,
        'quantity'=>1
    ];
    array_push($this->items,$item);
    }
    $this->updateTotalPrice();
}

    public function updateTotalPrice(){
       foreach($this->items as $value){
         $unitPrice=Product::find($value['id'])->price;
         $this->totalPrice+=$unitPrice*$value['quantity'];
       }
    }


    public function getProduct(){
        $products=[];
        foreach($this->items as $item){
            array_push($products,Product::find($item["id"]));
        }
        return $products;
    }

    public function showTotalPrice(){
     return number_format($this->totalPrice);
    }
    public function showPromotionPrice(){
    return number_format($this->promotionPrice);
    }
    public function deleteItem($id){
       foreach($this->items as $key=>$item){
           if($item["id"]==$id){
               array_splice($this->items,$key,1);
               break;
           }
       }
    }
    public function decrCart($id){
        foreach($this->items as $key=> $item){
            if($item["id"]==$id){
                if($item["quantity"]==1){
                     $this->deleteItem($id);
                }else{
                    $this->items[$key]["quantity"]-=1;
                    $this->updateTotalPrice();
                }
               break;
            }
        }
    }
    public function incrCart($id){
        foreach($this->items as $key=> $item){
            if($item["id"]==$id){
                $this->items[$key]["quantity"]+=1;
                $this->updateTotalPrice();
                break;
            }
        }
    }
    public function discount($value){
        $value=(int)$value;
        $this->promotionPrice=round($this->totalPrice*(1-$value/100),0);
    }


}
