<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Biodata;

class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }

    public function postRegister(Request $req){
        $this->validate($req, [
            'nidn' => 'required|unique:biodatas,nid',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);
        
        
        try {
            Biodata::create([
                'nid' => $req->nidn,
                'nama' => $req->name
            ]);
    
            User::create([
                'email' => $req->email,
                'password' => bcrypt($req->password),
                'bio_nid' => $req->nidn
            ]);

            $msg =['success' => 'Registrasi berhasil. silahkan login menggunakan email dan password yang telah anda buat.'];
        } catch (\Throwable $th) {
            $msg =['error' => 'Registrasi gagal.'];
        }
        
        return back()->with($msg);
    }
}
