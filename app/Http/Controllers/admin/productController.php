<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function GuzzleHttp\json_decode;

class productController extends Controller
{
    //
    function index(){
        if(Auth::check()){
            $product=Product::all();
            return view('admin.product',['product'=>$product,'option'=>"list"]);
        }else{
            echo "Error";
        }
    }
    function viewAddProduct(){
          return view("admin.product",["option"=>"add"]);
    }
    function insert(Request $req){
        $product=new Product();
        $product->name=$req->input('name');
        $product->type=$req->input('type');
        $product->brand=$req->input('brand');
        $product->mileage=$req->input('mileage');
        $product->year=$req->input('year');
        $product->price=$req->input('price');
        $product->slug=$req->slug;
       $img=json_decode($req->input('image'));
       $listImg=[];
        foreach($img as $value){
            if($product->type=='car'){
              array_push($listImg,$this->createImage($value,'storage/public/product/cars/'));
            }
            else{
                array_push($listImg,$this->createImage($value,'storage/public/product/motos/'));
            }
        }
        $product->image=json_encode($listImg);
        $product->save();
       return redirect('admin/product');
    }
    public function createImage($img,$folderPath)
    {
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '. '.'png';
        file_put_contents($file, $image_base64);
        return $file;
    }
    function edit($id){
        $product=Product::where('id','=',$id)->get();
        return view('admin.product',['product'=>$product,'option'=>"edit"]);
    }
    function remove($id){
        //TODO: delete product
        Product::where('id','=',$id)->delete();
        return redirect('admin/product');
    }

    function testDeleteFile(){
        $tring='["public\/product\/motos\/5ed64e1f393e0.jpeg"]';
        $tring=json_decode($tring);
        echo $tring[0];
        echo Storage::delete([$tring[0]]);
    }

    function update(Request $req){
        $id=$req->input('idUpdate');
        $product=Product::find($id);
        $product->name=$req->name;
        $product->type=$req->type;
        $product->brand=$req->brand;
        $product->year=$req->year;
        $product->price=$req->price;
        $product->mileage=$req->mileage;
        $newImage=json_decode($req->input('imageEdit'));
        $listImg=[];
         foreach($newImage as $value){
             if($req->type=='car'){
               array_push($listImg,$this->createImage($value,'storage/public/product/cars/'));
             }
             else{
                 array_push($listImg,$this->createImage($value,'storage/public/product/motos/'));
             }
         }
         $product->image=json_encode($listImg);
         $product->save();
        return redirect()->back()->with("notification","Product has been updated successfuly");
    }

    function slugSuggesstion(Request $req){
           $string=["a","b","c","d","e","f","g","h","k"];
           $slug=str_replace(" ","-",$req->name);
           $preSlug=explode("-",$slug);
           $n=count($preSlug);
           $product=Product::select("slug")->where("slug",$slug)->first();
           if($product){
               $isInString=false;
               for($i=0;$i<count($string)-1;$i++){
                if($preSlug[$n-1]==$string[$i]){
                    $preSlug[$n-1]=$string[$i+1];
                    $isInString=true;
                    break;
                  }
               }
               if(!$isInString){
                   array_push($preSlug,$string[0]);
               }
           }
           $slug=implode("-",$preSlug);
        return redirect()->back()->with(
            [
                "name"=>$req->name,
                "brand"=>$req->brand,
                "type"=>$req->type,
                "price"=>$req->price,
                "mileage"=>$req->mileage,
                "year"=>$req->year,
                "slug"=>$slug
            ]
            );
     }

}
