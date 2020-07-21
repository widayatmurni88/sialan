<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Biodata;

class LoginController extends Controller{

    public function GateRoute(){
        //checking user level for UI
        
        // switch (auth()->user()->level) {
        //     //for super user
        //     case 'super':
        //         break;
            
        //     //for admin pusat
        //     case 'admin':
        //         # code...
        //         break;
            
        //     //for admin instansi
        //     case 'instansi':
        //         # code...
        //         break;

        //     //for user
        //     case 'user':
        //         dd(\Auth::user());
        //         break;
            
        //     default:
        //         return abort(403);
        //         break;
        // }
    }

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
        
        if(!\Auth::attempt($credensial, true)){//true for remember login
            \Session::flash('msg', 'Email & Password not match!');
            return redirect()->back();
        }else{
            $userInfo = Biodata::where('nid',\Auth::user()->bio_nid)->first();
            $info = [
                'nid' => $userInfo->nid,
                'name' => $userInfo->nama
            ];
            \Session::put($info);
            //$this->GateRoute();
            //return redirect()->route('home');

            switch (auth()->user()->level) {
                case 'super':
                    return redirect()->route('superDash');
                    break;
                
                //for admin pusat
                case 'admin':
                    # code...
                    break;

                case 'instansi':
                    # code...
                    break;
                
                case 'user':
                    return redirect()->route('home');
                    break;
                
                default:
                    abort(403);
                    break;
            }
        }
        
    }

    public function logout(){
        \Auth::logout();
        return redirect()->route('login');
    }
}
