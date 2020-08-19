<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class MyProfileController extends Controller{

    public function index(){
        return $this->showEdit();
    }

    public function showEdit(){
        $userId = auth()->user()->id;
        $userAkun = User::select('id', 'email')
                                ->where('id', $userId)
                                ->first();
        $data = [
            'data' => $userAkun
        ];
        return view('admin.myprofile')->with($data);
    }

    public function postUpdateMyProfile(Request $req){
        $this->validate($req, ['email' => 'required']);
        $userId = $userId = auth()->user()->id;
        $curUserAkun = User::select('id', 'email')->where('id', $userId)->first();
        $setChange = false;
        $msg=[];

        $userUpdate = User::find($userId);

        if($curUserAkun->email != $req->email){
            $this->validate($req, ['email' => 'unique:users,email']);
            $userUpdate->email = $req->email;
            $setChange = true;
        }

        if (trim($req->password) != '') {
            $this->validate($req, ['password' => 'confirmed']);
            $userUpdate->password = bcrypt($req->password);
            $setChange = true;
        }

        if($setChange){
            $userUpdate->update();
            $msg = ['success' => 'Sukses melakukan update data']; 
        }

        return back()->with($msg);

    }
}
