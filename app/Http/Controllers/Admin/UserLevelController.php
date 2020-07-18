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

        dd($data['level']);
        return view('admin.userlevel')->with($data);
    }

    public function tambahLevel(){
        return view('admin.userlevel_add');
    }

    public function postTambahLevel(Request $req){
        $this->validate($req,[
            'level' => 'required'
        ]);
        
        $level = new UserLevel();
        $level->level = $req->level;
        $level->save();

        return back()->with(['success' => 'Success. klik "Kembali" untuk lihat']);
    }
}
