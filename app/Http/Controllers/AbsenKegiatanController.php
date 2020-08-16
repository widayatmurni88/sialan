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

        //cek hari libur or not
        // $harilibur = new _cekHariLibur();

        // $harilibur = $harilibur->ceklibur(date('Y-m-d', strtotime(now())));

        // if (!$harilibur['status']){
        //     dd('bukan hari libur');
        // }else{
        //     dd('hari libur');
        // }

        if (date('His', strtotime(now())) >= date('His', strtotime(jammasuk))){
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
                    $absen->waktu_masuk = Carbon::now();
                    $absen->tgl_absen   = Carbon::now();
                    $absen->save();
                    $msg = ['status' => TRUE, 'message' => 'Terimakasih sudah absen hari ini'];
                }else{
                    $msg = ['status' => TRUE, 'message' => 'Sudah absen'];
                }
    
            // } catch (\Throwable $th) {
            //     $msg = ['error' => 'internal server eror!'];
            // }
        }else{
            $msg = ['status' => TRUE, 'message' => 'Absen belum dibuka'];
        }

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

    protected function cekAbsenNow($nid){
        return Absen::where('bio_nid',$nid)
            ->where('tgl_absen', 'like', '%' . date('Y-m-d', strtotime(now())) . '%')
            ->first();
    }

    public function getIdAbsen($nid){
        $abs = $this->cekAbsenNow($nid);
        if($abs == null){
            $abs = 'null';
        }else{
            $abs = $abs->id;
        }
        return $abs;
    }

    public function getAbsenNow($nid){
        return $this->cekAbsenNow($nid);
    }

    public function absenPulang(Request $req){

        if (date('His', strtotime(now())) >= date('His', strtotime(jampulang))){
            $absen = Absen::find($req->id_absen);
            if ($absen != null){
                $absen->waktu_keluar = Carbon::now();
                $absen->update();
                return back();
            }else{
                $msg = ['status' => TRUE, 'message' => 'Sepertinya anda belum absen'];
                return back()->with($msg);
            }
        }else{
            $msg = ['status' => TRUE, 'message' => 'Belum diperbolehkan absen pulang'];
            return back()->with($msg);
        }
    }

}
