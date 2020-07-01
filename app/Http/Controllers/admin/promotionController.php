<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddPromotionRequest;
use App\Model\Promote;
use App\Model\PromoteLimited;
use Illuminate\Http\Request;
use App\User;

use function GuzzleHttp\json_decode;

class promotionController extends Controller
{
    //
    function index(){
        $promotion=Promote::all();
        foreach($promotion as $p){
            $p->users;
        }
        // echo "<pre>".json_encode($promotion,JSON_PRETTY_PRINT)."</pre>";
        return view('admin.promotion',["promotion"=>$promotion,"option"=>"list"]);
    }
    function viewAddPromotion(){
        $users=User::all();
        return view("admin.promotion",["option"=>"add","users"=>$users]);
    }
    function addPromotion(AddPromotionRequest $req){
        $promotion = new Promote();
        $promotion->name=$req->name;
        $promotion->discount=$req->discount;
        $promotion->limited=$req->limited;
        $users=json_decode($req->users);
        $promotion->save();
         foreach($users as $u){
            //  $promotion->users->id=$u;
             $limited= new PromoteLimited();
             $limited->user_id=$u;
             $limited->promote_id=$promotion->id;
             $limited->save();
         }

         return redirect()->back()->with("notification","Promotion has been added successfuly");
    }

    function edit($id){
         $promotion=Promote::find($id);
         $promotion->users;
         $users=User::select("id","email");
         foreach($promotion->users as $p){
             $users->where("id","<>",$p->id);
         }
         $users=$users->get();
        //  echo "<pre>".json_encode($users,JSON_PRETTY_PRINT)."</pre>";
         return view("admin.promotion",[
             "promote"=>$promotion,
             "option"=>"edit",
             "users"=>$users
         ]);
    }
    function update(Request $req){
         $id=$req->id;
         $promotion=Promote::find($id);
         $promotion->name=$req->name;
         $promotion->discount=$req->discount;
         $promotion->limited=$req->limited;
         $oldUsers=$promotion->users;
         foreach($oldUsers as $u){
          PromoteLimited::where("promote_id",$id)->where("user_id",$u->id)->first()->delete();
        }
         $users=json_decode($req->users);
         foreach($users as $u){
           $proLimited=new PromoteLimited();
           $proLimited->user_id=$u;
           $proLimited->promote_id=$promotion->id;
           $proLimited->save();
         }
         return redirect()->back()->with('notification',"Promotion has been updated successfuly");
    }

    function delete($id){
        $promotion=Promote::find($id);
        PromoteLimited::where('promote_id',$promotion->id)->delete();
        $promotion->delete();
        return redirect()->back()->with('notification',"Promotion has been deleted successfuly");
    }
}
