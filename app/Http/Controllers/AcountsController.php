<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AcountsController extends Controller
{
    public function index(){
        $data =[
            'acounts' => User::All()
        ];
        return view('manageAcounts')->with($data);
    }

    public function deleteAcount($id){
        $user = User::find($id);
        $user->delete();
        return back();
    }
    
    public function setNewPassword(Request $req){
        $this->validate($req,[
            'password' => 'required|confirmed'
        ]);

        User::where('email',$req->email)->update(['password' => bcrypt($req->password)]);
        return true;
    }
}
