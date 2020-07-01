<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Model\Comment;
use App\Model\Product;
use App\Model\ProductRate;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class productController extends Controller
{
    //
    function index(){
        $products=Product::paginate(9);
        $brands=Product::select('brand')->orderBy('brand')->distinct()->get();
        $mileages=Product::select('mileage')->orderBy('mileage')->distinct()->get();
        $years=Product::select('year')->orderBy('year')->distinct()->get();
        $cart = Session('cart')?Session::get('cart'):[];
        if($cart!=null){
        $quantityCart=count($cart->items);}
        else{
            $quantityCart=0;
        }
        return view('product.productList',
        ['products'=>$products,'brands'=>$brands,'mileages'=>$mileages,'years'=>$years,'quantityCart'=>$quantityCart]);
    }

    function detail($slug){
        $cart = Session('cart')?Session::get('cart'):[];
        if($cart!=null){
        $quantityCart=count($cart->items);}
        else{
            $quantityCart=0;
        }
        $product=Product::where('slug','like',$slug)->get();
       return view('product.detail',
       [
           'product'=>$product,
           'comments'=>Comment::where('product_id',"=",$product[0]->id)->get(),
           'quantityCart'=>$quantityCart,
           'userRated'=>count(ProductRate::where('product_id',$product[0]->id)->get())
        ]
    );
    }
    function comment(Request $req){
        if(Auth::check()){
        $comment=new Comment();
        $comment->user_id=Auth::user()->id;
        $comment->product_id=$req->product_id;
        $comment->content=$req->content;
        $comment->save();
        return redirect()->back();}
        else{
           return redirect("/login");
        }
    }
    function search(Request $req){
        if($req->input('option')=='searchFilter'){
            $type=$req->input('type');
            $brand=$req->input('brand');
            $mileage=$req->input('mileage');
            $year=$req->input('year');
            $filterAmoutInput=$req->input('filterAmount');
            $filterAmount=json_decode($filterAmoutInput);
            foreach($filterAmount as $key=>$i){
            $filterAmount[$key]=(float)$i;
            }

            $resultsQuery=Product::where('price','>=',$filterAmount[0])->where('price','<=',$filterAmount[1]);
            if($type!=''){
                $resultsQuery=$resultsQuery->where('type','like',$type);
            }
            if($brand!=''){
                $resultsQuery=$resultsQuery->where('brand','like',$brand);
            }
            if($mileage!=''){
                $resultsQuery=$resultsQuery->where('mileage','like',$mileage);
            }
            if($year!=''){
                $resultsQuery=$resultsQuery->where('year','like',$year);
            }
            $results=$resultsQuery->paginate(9);

            return view('product.productList',
            [
                'products'=>$results,
                'brands'=>Product::select('brand')->orderBy('brand')->distinct()->get(),
                'mileages'=>Product::select('mileage')->orderBy('mileage')->distinct()->get(),
                'years'=>Product::select('year')->orderBy('year')->distinct()->get(),
                'typeSearch'=>$type,
                'brandSearch'=>$brand,
                'mileageSearch'=>$mileage,
                'yearSearch'=>$year,
                'fillterAmoutSearch'=>$filterAmoutInput
            ]);

         }else{
             $text=$req->input('textSearch');
             $query=Product::
            where('name','like','%'.$text.'%')
            ->orWhere('price','=',(float)$text)
            ->orWhere('brand','like','%'.$text.'%')->paginate(9);
            return view('product.productList',
            [
                'products'=>$query,
                'brands'=>Product::select('brand')->orderBy('brand')->distinct()->get(),
                'mileages'=>Product::select('mileage')->orderBy('mileage')->distinct()->get(),
                'years'=>Product::select('year')->orderBy('year')->distinct()->get(),
                'textSearch'=>$text
            ]);
         }
     }
    function searchText(Request $req){
        $text=$req->input('textSearch');
         $query=Product::
         where('name','like','%'.$text.'%')
         ->orWhere('price','=',(float)$text)
         ->orWhere('brand','like','%'.$text.'%')->get();
         return view('product.productList',
         [
             'products'=>$query,
             'brands'=>DB::table('products')->select('brand')->orderBy('brand')->distinct()->get(),
              'mileages'=>DB::table('products')->select('mileage')->orderBy('mileage')->distinct()->get(),
             'years'=>DB::table('products')->select('year')->orderBy('year')->distinct()->get(),
             'textSearch'=>$text
        ]);
    }
    function rate(Request $req){
        echo $req->productId;
        $productRate=ProductRate::where('user_id',Auth::user()->id)->where('product_id',$req->productId)->get();
        if(count($productRate)){
        $productRate[0]->rate=$req->rate;
        $productRate[0]->save();
        $this->updateRateScore($req->productId);
        }else{
            $Rate= new ProductRate();
            $Rate->user_id=Auth::user()->id;
            $Rate->product_id=$req->productId;
            $Rate->rate=$req->rate;
            $Rate->save();
            $this->updateRateScore($req->productId);
        }
        return redirect()->back();
    }
    function updateRateScore($productId){
           $product=Product::find($productId);
           $listRate=ProductRate::where('product_id',$product->id)->get();
           $avg=0;
           foreach($listRate as $r){
              $avg+=$r->rate;
           }
           $avg=(float)$avg/count($listRate);
           $product->rate=$avg;
           $product->save();
    }
}

