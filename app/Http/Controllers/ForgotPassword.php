<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

use App\Models\PasswordReset;
use App\Models\User;
use App\Mail\SentResetPassword;
use App\Http\Controllers\AcountsController;


class ForgotPassword extends Controller{

    public function index(){
        return view('forgotPassword');
    }

    public function postForgotPassword(Request $req){

        $this->validate($req, [
            'email' => 'required|email|exists:users,email'
        ]);

        //TODO: kirim link ke email user

        //cek token yang dibuat masih aktif atau tidak -> biar ndak ulang2 buat reset token
        $reset = PasswordReset::select('token')->where('email','=',$req->email, 'and')->where('expired','=', '0')->get();
        if (count($reset)>0){
            //TODO: ambil email dan token untuk dikirimkan ulang
            $fieldReset = [
                'email' => $req->email,
                'token' => $reset[0]->token
            ];
        }else{
            //TODO: Buat token baru
            $fieldReset = [
                'email' => $req->email,
                'token' => Str::random(60)
            ];
            $reset = PasswordReset::create($fieldReset);
        }

        if ($this->sendResetToEmail($fieldReset)){
            $msg=['success' => 'Permintaan reset password anda telah dikirim ke email anda.'];
        }else{
            $msg=['error' => 'Gagal mengirimkan ke email'];
        }

        return back()->with($msg);
    }

    public function resetPwd($tkn, Request $req){
        //TODO: cek email dan token-> buat session -> tampilkan form setNewpassword

        $cekReset = PasswordReset::select(['email','token','expired'])->where('email',$req->email)->where('token', $tkn);

        if(count($cekReset->get())>0){
            if(!$cekReset->first()->expired){
                //update token expired
                PasswordReset::where('email',$req->email)->where('token', $tkn)->update(['expired' => 1]);
                return view('setNewPassword')->with(['email'=> $req->email]);
            }else{
                return redirect()->route('forgotPwd')->with('error', 'Link expired');
            }
        }else{
            return redirect()->route('forgotPwd')->with('error', 'Wrong link ');
        }
    }

    public function setNewPassword(Request $req){
        //ambil email dari session baru settpassword baru

        $this->validate($req, [
            'password' => 'required|confirmed'
        ]);

        $akun = new AcountsController();
        if($akun->setNewPassword($req)){
            return back()->with(['success' => 'New password has been saved.']);
        }else{
            return redirect()->route('forgotPwd')->with('error', 'Faild to set new passwor! please request set new password again.'); 
        }
    }

    protected function sendResetToEmail($fieldReset){
        $urlReset = config('app.url').'/ForgotPassword/reset/'.$fieldReset['token'].'?email='.$fieldReset['email'];

        try {
            Mail::to($fieldReset['email'])->send(new SentResetPassword($urlReset));
            return true;
        } catch (\Exception $e) {
            return false;
        }

    }



}
