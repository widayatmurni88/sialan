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

    public function editLevel($id){
        $data =[
            'level' => UserLevel::find($id)
        ];

        return view('admin.userlevel_edit')->with($data);
    }

    public function postTambahLevel(Request $req){
        $this->validate($req,[
            'level' => 'required'
        ]);
        
        try {
            $level = new UserLevel();
            $level->level = $req->level;
            $level->save();

            $msg= ['success' => 'Success. klik "Kembali" untuk lihat'];
        } catch (\Throwable $th) {
            $msg= ['error' => 'Server Error'];
        }

        return back()->with($msg);
    }

    public function putLevel(Request $req){
        $this->validate($req,[
            'id' => 'required',
            'level' => 'required'
        ]);
        
        try {
            $level = UserLevel::find($req->id);
            $level->level = $req->level;
            $level->update();

            $msg= ['success' => 'Success. klik "Kembali" untuk lihat'];
        } catch (\Throwable $th) {
            $msg= ['error' => 'Server Error'];
        }

        return back()->with($msg);
    }
}
