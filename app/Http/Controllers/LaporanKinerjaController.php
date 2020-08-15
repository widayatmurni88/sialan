<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\Instansi;
use App\Models\Biodata;
use App\Models\Surattj;
use PDF;

class LaporanKinerjaController extends Controller
{
    public function index($data=null){

        //cek login as
        if (auth()->user()->level == 'admin') {
            $data = [
                'periode_bln' => date('m', strtotime(now())),
                'periode_thn' => date('Y', strtotime(now())),
                'kehadiran' => null
            ];
            return $this->laporanAllInstansi(null, $data);
        }else{
            return $this->laporanPerInstansi($data);
        }
        
    }

    protected function laporanAllInstansi($instansi, $absen){
        $data =[
            'instansi'    => Instansi::All(),
            'curinstansi' => $instansi,
            'absen'       => $absen
        ];

        return view('laporankehadiran')->with($data);
    }
    
    protected function laporanPerInstansi($data){
        if($data==null){
            $data = $this->getKehadiranPerInstansi(
                        session()->get('id_instansi'),
                        date('m', strtotime(now())),
                        date('Y', strtotime(now()))
                    );
        }
        return view('laporanperinstansi')->with('data', $data);
    }

    public function getAbsen(Request $req){
        $this->validate($req,[
            'instansi' => 'integer|between:1,12',
            'bulan' => 'required|numeric',
            'tahun' => 'required|numeric'
        ]);

        if ($req->instansi!=null){
            $data = $this->getKehadiranPerInstansi($req->instansi, $req->bulan, $req->tahun);
        }else{
            $data = null;
        }

        return $this->laporanAllInstansi($req->instansi, $data);
        
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

        if(auth()->user()->level == 'user'){
            return abort(403);
        }

        $kehadiran = [];
        $hadir=[];

        $absen = Absen::select('absens.id as ab_id', 
                                'absens.tgl_absen as tgl', 
                                'absens.bio_nid as nid', 
                                'ranks.pangkat as pangkat', 
                                'biodatas.nama as nama')
                        ->join('ranks', 'ranks.id', '=', 'absens.pangkat_id')
                        ->leftJoin('biodatas', 'biodatas.nid', '=', 'absens.bio_nid')
                        ->join('users', 'users.bio_nid', '=', 'absens.bio_nid')
                        ->where('absens.instansi_id', $idInstansi)
                        ->where('users.level', 'user')
                        ->whereMonth('absens.tgl_absen', '=', $bulan)
                        ->whereYear('absens.tgl_absen', '=', $tahun)
                        ->orderBy('absens.bio_nid', 'ASC')
                        ->orderBy('absens.tgl_absen', 'ASC')
                        ->get();
        
        
        // $person = Absen::select('absens.bio_nid as nid', 
        //                         'ranks.pangkat as pangkat', 
        //                         'biodatas.nama as nama')
        //                 ->join('ranks', 'ranks.id', '=', 'absens.pangkat_id')
        //                 ->leftJoin('biodatas', 'biodatas.nid', '=', 'absens.bio_nid')
        //                 ->where('absens.instansi_id', $idInstansi)
        //                 ->whereMonth('absens.tgl_absen', '=', $bulan)
        //                 ->whereYear('absens.tgl_absen', '=', $tahun)
        //                 ->orderBy('absens.pangkat_id', 'ASC')
        //                 ->orderBy('absens.bio_nid', 'ASC')
        //                 ->orderBy('absens.tgl_absen', 'ASC')
        //                 ->groupBy('absens.bio_nid')
        //                 ->get();

        $allPerson = Biodata::select('biodatas.nid as nid',
                                     'ranks.pangkat as pangkat',
                                     'biodatas.nama as nama')
                            ->join('ranks', 'ranks.id', '=', 'biodatas.pangkat_id')
                            ->join('users', 'users.bio_nid', '=', 'biodatas.nid')
                            ->where('biodatas.instansi_id', $idInstansi)
                            ->where('users.level','user')
                            ->orderBy('biodatas.pangkat_id', 'ASC')
                            ->orderBy('biodatas.nid', 'ASC')
                            ->get();
        
        $surattj = Surattj::select('file_link as surat')
                                ->where('periode' , 'like', "%$tahun-$bulan%")
                                ->where('instansi_id', $idInstansi)
                                ->first();

        if($allPerson != null){
            foreach ($allPerson as $p) {
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

        if ($surattj!=null){
            $surattj=$surattj->surat;
        }

        $instansi = Instansi::select('id','nama_ins')->where('id',$idInstansi)->first();
        return [
            'periode_bln'   => $bulan,
            'periode_thn'   => $tahun,
            'id_instansi'   => $instansi->id,
            'instansi'      => $instansi->nama_ins,
            'surattj'       => $surattj,
            'kehadiran'     => $kehadiran
        ];
    }

    protected function getKegadiranAllInstansi(){
        # code...
    }

    protected function getKehadiran($idInstansi, $bulan, $tahun){
        $kehadiran = [];

        //semua user
        if ($instansi!=null) {
            $absen = Absen::select('absens.id as ab_id', 
                                    'absens.tgl_absen as tgl', 
                                    'absens.bio_nid as nid', 
                                    'ranks.pangkat as pangkat', 
                                    'biodatas.nama as nama')
                            ->join('ranks', 'ranks.id', '=', 'absens.pangkat_id')
                            ->leftJoin('biodatas', 'biodatas.nid', '=', 'absens.bio_nid')
                            ->where('absens.instansi_id', '<>', null)
                            ->whereMonth('absens.tgl_absen', '=', $bulan)
                            ->whereYear('absens.tgl_absen', '=', $tahun)
                            ->orderBy('absens.bio_nid', 'ASC')
                            ->orderBy('absens.tgl_absen', 'ASC')
                            ->get();

            $allPerson = Biodata::select('biodatas.nid as nid',
                                        'ranks.pangkat as pangkat',
                                        'biodatas.nama as nama')
                            ->join('ranks', 'ranks.id', '=', 'biodatas.pangkat_id')
                            ->where('biodatas.instansi_id', '<>', null)
                            ->orderBy('biodatas.pangkat_id', 'ASC')
                            ->orderBy('biodatas.nid', 'ASC')
                            ->get();                
        }
        //berdasarkan instansi
        else{
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
            
            // $person = Absen::select('absens.bio_nid as nid', 
            //                         'ranks.pangkat as pangkat', 
            //                         'biodatas.nama as nama')
            //                 ->join('ranks', 'ranks.id', '=', 'absens.pangkat_id')
            //                 ->leftJoin('biodatas', 'biodatas.nid', '=', 'absens.bio_nid')
            //                 ->where('absens.instansi_id', $idInstansi)
            //                 ->whereMonth('absens.tgl_absen', '=', $bulan)
            //                 ->whereYear('absens.tgl_absen', '=', $tahun)
            //                 ->orderBy('absens.pangkat_id', 'ASC')
            //                 ->orderBy('absens.bio_nid', 'ASC')
            //                 ->orderBy('absens.tgl_absen', 'ASC')
            //                 ->groupBy('absens.bio_nid')
            //                 ->get();
    
            $allPerson = Biodata::select('biodatas.nid as nid',
                                         'ranks.pangkat as pangkat',
                                         'biodatas.nama as nama')
                                ->join('ranks', 'ranks.id', '=', 'biodatas.pangkat_id')
                                ->where('biodatas.instansi_id', $idInstansi)
                                ->orderBy('biodatas.pangkat_id', 'ASC')
                                ->orderBy('biodatas.nid', 'ASC')
                                ->get();
                            
        }
                        

        if($allPerson != null){
            foreach ($allPerson as $p) {
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
        $person = $ref->cekReference($idInstansi);
        $idkepala = null;
        
        if($person != null){
            $idkepala = $person->id;
        }

        $data = [
                'data'      => $this->getKehadiranPerInstansi($idInstansi, $bulan, $tahun),
                'kepala'    => $ref->getReference($idkepala)
            ];


        $customPaper = array(0,0,850,1300);
        $pdf = PDF::loadview('printabsen', $data)->setPaper('A4', 'landscape');
        $pdf->setOptions(['dpi' => 120,'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(790, 10, "Hal : {PAGE_NUM} / {PAGE_COUNT}", null, 7, array(0, 0, 0));

        return $pdf->stream();
    }

    public function printSurattj($file){

        $pdf = PDF::loadview('printsurattj', ['file' => $file])->setPaper('A4', 'portrait');
        $pdf->setOptions(['dpi' => 120,'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        return $pdf->stream();
    }
}
