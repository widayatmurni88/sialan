<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\Instansi;
use PDF;

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
            'bulan' => 'required',
            'tahun' => 'required'
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
                        ->orderBy('absens.pangkat_id', 'ASC')
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
        $instansi = Instansi::select('id','nama_ins')->where('id',$idInstansi)->first();
        return [
            'periode_bln'   => $bulan,
            'periode_thn'   => $tahun,
            'id_instansi'   => $instansi->id,
            'instansi'  => $instansi->nama_ins,
            'kehadiran' => $kehadiran
        ];
    }

    public function printLaporan($idInstansi, $bulan, $tahun){
        $ref = new TtdReferenceController();
        $person = $ref->cekReference(session()->get('id_instansi'));
        
        $data = [
                'data'      => $this->getKehadiranPerInstansi($idInstansi, $bulan, $tahun),
                'kepala'    => $ref->getReference($person->id)
            ];


        $customPaper = array(0,0,850,1300);
        $pdf = PDF::loadview('printabsen', $data)->setPaper($customPaper, 'landscape');
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(1210, 20, "Hal : {PAGE_NUM} / {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->stream();
    }
}
