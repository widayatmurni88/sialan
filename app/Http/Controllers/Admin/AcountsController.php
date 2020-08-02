<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Biodata;

class AcountsController extends Controller
{
    public function index(){
        $data = [
            'acounts' => User::select('users.id as akun_id', 
                                      'users.email as email', 
                                      'users.level as lvl', 
                                      'users.bio_nid as nid', 
                                      'bio.nama as name')
                            ->leftJoin('biodatas as bio', 'bio.nid', '=', 'users.bio_nid')
                            ->orderBy('users.level', 'ASC')
                            ->get()
        ];
        return view('admin.manageakun')->with($data);
    }

    public function deleteAkun($id){
        $curActive = auth()->user();
        if ($curActive->id == $id){
            $msg = ['error' => 'Forbiden delete'];
        }else{
            $user = User::find($id);
            $bio = Biodata::where('nid',$user->bio_nid);
            $bio->delete();
            // $user->delete();
            $msg = ['success' => 'User berhasil di hapus'];
        }

        return back()->with($msg);
    }

    public function getEditAkun($id){
        try {
            $data =[
                'akun' => User::find($id)
            ];
        } catch (\Throwable $th) {
            $data = ['error' => 'Server Error'];
        }

        return view('admin.manageakun_edit')->with($data);
    }

    public function updateLevel(Request $req){
        $req->validate([
            'level' => 'required'
        ]);

        $user = User::find($req->id);
        $user->level = $req->level;
        $user->update();

        return back()->with(['success'=>'Update Success']);
    }
}
