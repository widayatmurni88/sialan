<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RankUser;

class RankController extends Controller
{
    public function index(){
        $data = [
            'ranks' => RankUser::select('id as id', 'pangkat as rank')->get()
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
            $msg = ['error' => 'Gagal menambahkan.'];
        }

        return back()->with($msg);
    }

    public function postRankSerach(Request $req){
      if(trim($req->cari)==''){
        return redirect()->route('setPangkat');
      }else{
        $data = [
          'ranks' => RankUser::select('id as id', 'pangkat as rank')->where('pangkat', 'like' ,"%$req->cari%")->get()
        ];
        return view('admin.setrank')->with($data);
      }
    }

    public function editPangkat($id){
      $data = [
        'ranks' => RankUser::select('id as id', 'pangkat as rank')->where('id', $id)->first()
      ];
      return view('admin.setrank_edit')->with($data);
    }

    public function postEditPangkat(Request $req){
      $this->validate($req,[
          'id' => 'required',
          'pangkat' => 'required'
      ]);
      try {
          $pangkat = RankUser::find($req->id);
          $pangkat->pangkat = $req->pangkat;
          $pangkat->update();
          $msg = ['success' => 'Data berhasil diupdate.'];
      } catch (\Throwable $th) {
          $msg = ['error' => 'Gagal melakukan update.'];
      }
      return back()->with($msg);
    }

    public function deletePangkat($id){
      try {
          $pangkat = RankUser::find($id);
          $pangkat->delete();
          $msg = ['success' => 'Data berhasil hihapus.'];
      } catch (\Throwable $th) {
          $msg = ['error' => 'Gagal melakukan hapus data.'];
      }
      return back()->with($msg);
    }
}
