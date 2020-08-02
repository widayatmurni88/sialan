<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\Instansi;
use App\Models\Biodata;
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
            return $this->laporanAllInstansi(0, $data);
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
                        date('Y', strtotime(now())),
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
