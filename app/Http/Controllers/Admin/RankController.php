<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RankUser;

class RankController extends Controller
{
    public function index($cari=''){
        if (trim($cari) == '') {
          $pangkat = RankUser::select('id as id', 'pangkat as rank')->get();
        }else{
          $pangkat = RankUser::select('id as ID', 'pangkat as rank')->where('pangkat', 'like' ,"%$cari%")->get();
        }

        $data = [
            'ranks' => $pangkat
        ];

        return view('admin.setrank')->with($data);
    }

    public function tambahPangkat(){
        return view('admin.setrank_add');
    }

    public function postPangkat(Request $req){
        $this->validate($req,[
            'pangkat' => 'required'
        ]);
        try {
            $pangkat = new RankUser();
            $pangkat->pangkat = $req->pangkat;
            $pangkat->save();
            $msg = ['success' => 'Data berhasil ditambahkan.'];
        } catch (\Throwable $th) {
            $msg = ['success' => 'Gagal menambahkan.'];
        }

        return back()->with($msg);
    }

    public function postRankSerach(Request $req){
      return redirect()->route('setPangkat', $req->cari);
    }
}
