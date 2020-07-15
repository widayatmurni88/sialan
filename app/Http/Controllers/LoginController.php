<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller{
    public function login(){
        return view('login');
    }

    public function cekLogin(Request $req){
        //buat cek yang diinput email atau username

        $this->validate($req, [
            "Username" => "required",
            "Password"   => "required"
        ]);
        
        $credensial = [
            'email' => $req->Username,
            'password' => $req->Password
            ];
        
        //check email atau username
        // if(filter_var($req->Username, FILTER_VALIDATE_EMAIL)){
        //     $credensial = [
        //     'email' => $req->Username,
        //     'password' => $req->Password
        //     ];
        // }
        
        if(!\Auth::attempt($credensial)){
            \Session::flash('msg', 'Email & Password not match!');
            return redirect()->back();
        }

        return redirect()->route('home');
    }

    public function logout(){
        \Auth::logout();

        return redirect()->route('login');
    }
}
