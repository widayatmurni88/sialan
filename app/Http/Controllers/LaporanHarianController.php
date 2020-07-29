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
        return view('dokkegiatan_add')->with($msg);
    }

    public function postAddKegiatanHarian(Request $req){
        $this->validate($req,[
            'id_absen'  => 'required',
            'title'     => 'required',
            'dokumen'   => 'max:5120'
        ]);
        

        //upload move filenya dulu baru simpen ke db
        try {
            $id = date('YmdHis', strtotime(now()));
            $fileName = '';
            $file = $req->file('dokumen');
            
            if($file != null){
                $fileName = $id.'.'.$file->getClientOriginalExtension();
                $file->move('docs/',$fileName);
            }
    
            $docKegiatan = new DocKegiatan();
            $docKegiatan->id           = $id;
            $docKegiatan->absen_id     = $req->id_absen;
            $docKegiatan->title        = $req->title;
            $docKegiatan->desk         = $req->desc;
            $docKegiatan->file_link    = $fileName;
            $docKegiatan->save();
            return back();
        } catch (\Throwable $th) {
            return abort(500);
        }
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

    public function previewKegiatan($idKegiatan){
        $data = [
            'kegiatan' => DocKegiatan::where('id', $idKegiatan)->select('id', 'title as ttl', 'desk as desc', 'file_link as file', 'updated_at as time')->first()
        ];
        return view('dokkegiatan_preview')->with($data);
    }

    public function editkegiatanharian($idKegiatan){
        $data = [
            'kegiatan' => DocKegiatan::where('id', $idKegiatan)->select('id', 'title as ttl', 'desk as desc', 'file_link as file', 'updated_at as time')->first()
        ];
        return view('dokkegiatan_edit')->with($data);
    }

    public function postEditKegiatanHarian(Request $req){
        $this->validate($req,[
            'id'        => 'required',
            'title'     => 'required',
            'dokumen'   => 'max:5120'
        ]);
        
        if($req->dokumen != null){
            $file = $req->file('dokumen');
            $fileName = $req->id.'.'.$file->getClientOriginalExtension();
            $file->move('docs/', $fileName);
        }

        $kegiatan = DocKegiatan::find($req->id);
        $kegiatan->title = $req->title;
        $kegiatan->desk  = $req->desc;
        if($req->dokumen != null){
            $kegiatan->file_link = $fileName;
        }
        $kegiatan->update();

        return redirect()->route('dashboard');
    }

    public function getAbsenPerUser($nid){
        $hadir = Absen::where('bio_nid', $nid)->get();

        foreach ($hadir as $d) {
            $dataHadir [] = [
                'id'    => $d->id,
                'title' => 'Hadir',
                'start' => $d->tgl_absen
            ];
        }

        return response()->json($dataHadir);
    }
}
