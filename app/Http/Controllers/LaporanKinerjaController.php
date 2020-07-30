<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\Instansi;

class LaporanKinerjaController extends Controller
{
    public function index($data=null){
        
        if($data==null){
            $data = $this->getKehadiranPerInstansi(
                        session()->get('id_instansi'),
                        date('m', strtotime(now())),
                        date('Y', strtotime(now())),
                    );
        }

        return view('laporanperinstansi')->with('data', $data);
    }

    public function getAbsenPerInstansi(Request $req){
        $this->validate($req, [
            'bulan' => 'required|numeric',
            'tahun' => 'required|numeric'
        ]);
        
        $data = $this->getKehadiranPerInstansi(
                            session()->get('id_instansi'),
                            $req->bulan,
                            $req->tahun
                        );

        return $this->index($data);
    }

    public function getKehadiranPerInstansi($idInstansi, $bulan, $tahun){

        if(auth()->user()->level !== 'instansi'){
            dd(auth()->user()->level);
            return abort(403);
        }

        $kehadiran = [];

        $absen = Absen::select('absens.id as ab_id', 
                                'absens.tgl_absen as tgl', 
                                'absens.bio_nid as nid', 
                                'ranks.pangkat as pangkat', 
                                'biodatas.nama as nama')
                        ->join('ranks', 'ranks.id', '=', 'absens.pangkat_id')
                        ->leftJoin('biodatas', 'biodatas.nid', '=', 'absens.bio_nid')
                        ->where('absens.instansi_id', $idInstansi)
                        ->whereMonth('absens.tgl_absen', '=', $bulan)
                        ->whereYear('absens.tgl_absen', '=', $tahun)
                        ->orderBy('absens.bio_nid', 'ASC')
                        ->orderBy('absens.tgl_absen', 'ASC')
                        ->get();

        
        $person = Absen::select('absens.bio_nid as nid', 
                                'ranks.pangkat as pangkat', 
                                'biodatas.nama as nama')
                        ->join('ranks', 'ranks.id', '=', 'absens.pangkat_id')
                        ->leftJoin('biodatas', 'biodatas.nid', '=', 'absens.bio_nid')
                        ->where('absens.instansi_id', $idInstansi)
                        ->whereMonth('absens.tgl_absen', '=', $bulan)
                        ->whereYear('absens.tgl_absen', '=', $tahun)
                        ->orderBy('absens.bio_nid', 'ASC')
                        ->orderBy('absens.tgl_absen', 'ASC')
                        ->groupBy('absens.bio_nid')
                        ->get();

        if($person != null){
            foreach ($person as $p) {
                if($absen != null){
                    foreach ($absen as $ab) {
                        if($p->nid == $ab->nid){
                            $hadir [] = [$ab->tgl];  
                        }
                    }
                }
                $kehadiran [] = [
                    'nid'       => $p->nid,
                    'nama'      => $p->nama,
                    'pangkat'   => $p->pangkat,
                    'hadir'     => $hadir
                ];
                $hadir = [];
            }
        } 
        return [
            'periode_bln'   => $bulan,
            'periode_thn'   => $tahun,
            'instansi'  => Instansi::select('nama_ins')->where('id',$idInstansi)->first()->nama_ins,
            'kehadiran' => $kehadiran
        ];
    }
}
