<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Biodata;
use App\Models\Absen;

class AbsenKegiatanController extends Controller
{
    public function Absensi(Request $req){
        $this->validate($req,[
            'nid' => 'required'
            ]);
        $nid        = $req->nid;
        $pangkat_id = $req->pangkat_id;
        $ins_id     = $req->instansi_id;
        
        //try {
            if ((trim($pangkat_id) == '') || (trim($ins_id)== '')){
                $bio = Biodata::find($nid);
                $pangkat_id = $bio->pangkat_id;
                $ins_id     = $bio->instansi_id;
            }

        // } catch (\Throwable $th) {
        //     $msg = ['error' => 'id '. $nid . ' tidak ditemukan'];
        // }
        
        // try {
            //cek absen
            if(!$this->cekStatusAbsen($nid)){
                $absen = new Absen();
                $absen->bio_nid     = $nid;
                $absen->pangkat_id  = $pangkat_id;
                $absen->instansi_id = $ins_id;
                $absen->tgl_absen   = Carbon::now();
                $absen->save();
                $msg = ['status' => TRUE, 'message' => 'Terimakasih sudah absen hari ini'];
            }else{
                $msg = ['status' => TRUE, 'message' => 'Sudah absen'];
            }

        // } catch (\Throwable $th) {
        //     $msg = ['error' => 'internal server eror!'];
        // }

        return back()->with($msg);
    }

    private function cekStatusAbsen($id){
        $abs = Absen::where('bio_nid',$id)->where('tgl_absen', 'like', '%' . date('Y-m-d', strtotime(now())) . '%')->first();

        if($abs == null){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function getIdAbsen($nid){
        $abs = Absen::where('bio_nid',$nid)->where('tgl_absen', 'like', '%' . date('Y-m-d', strtotime(now())) . '%')->select('id')->first();
        if($abs == null){
            $abs = 'null';
        }else{
            $abs = $abs->id;
        }
        return $abs;
    }
}
