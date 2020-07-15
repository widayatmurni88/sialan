<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }

    public function postRegister(Request $req){
        $this->validate($req, [
            'nidn' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        User::create([
            'nidn' => $req->nidn,
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password)
        ]);


        //login

        return redirect()->route('home');

    }
}
