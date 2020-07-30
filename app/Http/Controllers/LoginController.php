<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Biodata;

class LoginController extends Controller{

    protected $uinfo;

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
        
        if(!\Auth::attempt($credensial, false)){//true for remember login
            \Session::flash('msg', 'Email & Password not match!');
            return redirect()->back();
        }else{
            $this->setSessionData(\Auth::user()->bio_nid, false);
            //$this->GateRoute();
            //return redirect()->route('home');

            switch (auth()->user()->level) {
                case 'super':
                    return redirect()->route('superDash');
                    break;
                
                case 'user' || 'admin' || 'isntansi':
                    /* 
                    pemisahan antara admin pusat, admin instans dan user di lakukan di side menu 
                    pake teknik police
                    */
                    //cek new user(redirect to update profil) or old
                    if($this->uinfo->created_at == $this->uinfo->updated_at){
                        return redirect()->route('profile');
                    }else{
                        return redirect()->route('dashboard');
                    }
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

    //set Session data tambahan
    //$UpdateSession => indicate to update session data
    public function setSessionData($userId, $UpdateSession){
        $this->uinfo = Biodata::find($userId);
        if ($UpdateSession) {
            session()->forget(['nid','name', 'id_pangkat', 'id_instansi', 'profil_photo']);    
        }
        session()->put([
            'nid'           => $this->uinfo->nid,
            'name'          => $this->uinfo->nama,
            'id_pangkat'    => $this->uinfo->pangkat_id,
            'id_instansi'   => $this->uinfo->instansi_id,
            'profil_photo'  => $this->uinfo->profil_img
        ]);
    }
}
