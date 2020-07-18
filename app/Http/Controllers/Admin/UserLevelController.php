<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserLevel;

class UserLevelController extends Controller
{
    public function index(){
        $data =[
            'level' => UserLevel::All()
        ];

        return view('admin.userlevel')->with($data);
    }

    public function tambahLevel(){
        return view('admin.userlevel_add');
    }

    public function postTambahLevel(Request $req, $action){
        $this->validate($req,[
            'level' => 'required'
        ]);
        
        $level = new UserLevel();
        $level->level = $req->level;
        try {
            if ($action == 'Add'){
                $level->save();
            }else{
                $level->update();
            }
            $msg= ['success' => 'Success. klik "Kembali" untuk lihat'];
        } catch (\Throwable $th) {
            $msg= ['error' => 'Server Error'];
        }

        return back()->with($msg);
    }
}
