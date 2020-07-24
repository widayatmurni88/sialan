<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\DocKegiatan;
use File;

class LaporanHarianController extends Controller
{
    public function index(){
        return view('lapkegiatanharian');
    }

    public function addKegiatanHarian($idabsen){
        $cekAbsen = Absen::find($idabsen);
        if ($cekAbsen == null ){
            $msg = ['status'=>FALSE , 'idabsen' => $idabsen];
        }else{
            $msg = ['status'=>TRUE, 'idabsen' => $idabsen];
        }
        return view('dok_kegiatan_add')->with($msg);
    }

    public function postAddKegiatanHarian(Request $req){
        $this->validate($req,[
            'id_absen'  => 'required',
            'title'     => 'required',
            'dokumen'   => 'max:5120'
        ]);
        

        //upload move filenya dulu baru simpen ke db
        $id = date('YmdHis', strtotime(now()));
        $file = $req->file('dokumen');
        $fileName = $id.'.'.$file->getClientOriginalExtension();
        $file->move('docs/',$fileName);

        $docKegiatan = new DocKegiatan();
        $docKegiatan->id           = $id;
        $docKegiatan->absen_id     = $req->id_absen;
        $docKegiatan->title        = $req->title;
        $docKegiatan->desk         = $req->desc;
        $docKegiatan->file_link    = $fileName;
        $docKegiatan->save();
        return back();
    }

    public function getKegiatan($idAbsen){
        return DocKegiatan::where('absen_id', $idAbsen)->orderBy('created_at','desc')->get();
    }

    public function deleteKegiatan($idKegiatan){
        try {
            //delete filenya juga
            $kegiatan = DocKegiatan::where('id', $idKegiatan)->select('file_link');
            $file = $kegiatan->first()->file_link;
            File::delete('docs/'.$file);
            $kegiatan->delete();
            $msg = ['ksuccess' => 'Data dihapus'];
        } catch (\Throwable $th) {
            $msg = ['kerror' => 'Gagal menghapus'];
        }

        return back()->with($msg);
    }
}
