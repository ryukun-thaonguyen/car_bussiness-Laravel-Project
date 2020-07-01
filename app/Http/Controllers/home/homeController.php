<?php

namespace App\Http\Controllers\home;
use App\Http\Controllers\Controller;
use App\model\Brand;
use App\Model\Cart;
use App\model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class homeController extends Controller
{
    function index(){
        $products=Product::paginate(8);
        $brands=Product::select('brand')->orderBy('brand')->distinct()->get();
        $mileages=Product::select('mileage')->orderBy('mileage')->distinct()->get();
        $years=Product::select('year')->orderBy('year')->distinct()->get();
        $cart = Session('cart')?Session::get('cart'):[];
        if($cart!=null){
        $quantityCart=count($cart->items);}
        else{
            $quantityCart=0;
        }
        return view('home.index',
        [
            'products'=>$products,
            'years'=>$years,
            'brands'=>$brands,
            'mileages'=>$mileages,
            'quantityCart'=>$quantityCart
        ]);
    }

    public function addToCart(Request $req, $id){
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($id);
        $req->session()->put('cart', $cart);
        return redirect()->back();
    }
}
