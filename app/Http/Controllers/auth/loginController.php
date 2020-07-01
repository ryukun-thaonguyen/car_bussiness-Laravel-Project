<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    //
    function index(){
        return view('auth.login');
    }

    function login(Request $req){
        $req->remember=='on'?$check=true:$check=false;
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password], $check)) {
            $user=Auth::user();
            if($user->role=='admin'){
                return redirect('admin/dashboard');
            }else{
                if($user->role=='shipper'){
                    return redirect('/shipper/dashboard');
                }else{
                    return redirect('/');
                }
            }
        }else{
            return redirect('/login');
        }

    }

    function logout(){
        Auth::logout();
        return redirect('/');
    }
}
