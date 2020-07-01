<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
    //
    function index(){
        return view('auth.register');
    }

    function register(Request $req){
        if($req->input('confirmPassword')==$req->input('password')){
        $fullName=$req->input('fullName');
        $gmail=$req->input('gmail');
        $password=Hash::make($req->input('password'));
        if(count(DB::table('users')->where('email','=',$gmail)->get())==0){
             $user= new User();
             $user->fullname=$fullName;
             $user->email=$gmail;
             $user->password=$password;
             $user->role="user";
             $user->save();
            return redirect('login');
        }else{
            echo 'gmail already exist';
        }}
        else{
            return redirect('/register');
        }
    }
}
