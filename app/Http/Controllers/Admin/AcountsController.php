<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modals\User;
use App\Modals\Biodata;

class AcountsController extends Controller
{
    public function index(){
        $data = [
            'acounts' => \DB::table('users')
                            ->leftJoin('biodatas as bio', 'bio.nid', '=', 'users.bio_nid')
                            ->select('users.id as akun_id', 'users.email as email', 'users.level as lvl', 'users.bio_nid as nid', 'bio.nama as name')
                            ->get()
        ];
        return view('admin.manageakun')->with($data);
    }

    public function deleteAkun($id){
        $curActive = auth()->user();
        if ($curActive->id = $id){
            $msg = ['error' => 'Forbiden delete'];
        }else{
            // $user = User::find($id);
            // $bio = Biodata::find($user->bio_id);
            // $bio->delete();
            // $user->delete();
            $msg = ['success' => 'User berhasil di hapus'];
        }

        return back()->with($msg);
    }
}
