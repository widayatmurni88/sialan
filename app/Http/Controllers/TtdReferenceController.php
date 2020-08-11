<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TtdReference;
use App\Models\Biodata;

class TtdReferenceController extends Controller{

    public function index(){
        $idInstansi = session()->get('id_instansi');
        $kepala = $this->cekReference($idInstansi);

        if ($kepala != null){
            $kepela= $kepala->id;
        }

        return $this->showView($kepala, $idInstansi);
    }

    protected function showView($nid, $idInstansi){

        $data = [
            'kepala' => $this->getReferenceInstansi($idInstansi),
            'persons' => $this->getReferencePersonInstansi($idInstansi)
        ];
        
        return view('ttdreference')->with($data);
    }

    public function cekReference($idInstansi){
        return TtdReference::select('bio_nid as id')
            ->where('instansi_id', $idInstansi)
            ->first();
    }

    public function getReferenceInstansi($idInstansi){
        return TtdReference::select('ttd_references.title', 
                             'biodatas.nid as id', 
                             'biodatas.nama as name', 
                             'ranks.pangkat as pangkat')
                        ->leftJoin('biodatas', 'biodatas.nid', '=', 'ttd_references.bio_nid')
                        ->join('ranks', 'ranks.id', '=', 'biodatas.pangkat_id')
                        ->where('ttd_references.instansi_id', $idInstansi)
                        ->first();
    }

    public function getReference($nid){
        return TtdReference::select('ttd_references.title', 
                             'biodatas.nid as id', 
                             'biodatas.nama as name', 
                             'ranks.pangkat as pangkat')
                        ->leftJoin('biodatas', 'biodatas.nid', '=', 'ttd_references.bio_nid')
                        ->join('ranks', 'ranks.id', '=', 'biodatas.pangkat_id')
                        ->where('biodatas.nid', $nid)
                        ->first();
    }

    public function getReferencePersonInstansi($idInstansi){
        return Biodata::select('nid as id', 'nama as name')
                        ->where('instansi_id', $idInstansi)
                        ->get();
    }

    public function seveReference(Request $req){
        $idInstansi = session()->get('id_instansi');
        $this->validate($req, [
            'title' => 'required',
            'person' => 'required'
        ]);

        $cekUpdate = TtdReference::where('instansi_id', $idInstansi)->first();

        if($cekUpdate != null){
            $ref = $cekUpdate;
            $ref->title = $req->title;
            $ref->bio_nid = $req->person;
            $ref->instansi_id = $idInstansi;
            $ref->update();
        }else{
            $ref = new TtdReference();
            $ref->title = $req->title;
            $ref->bio_nid = $req->person;
            $ref->instansi_id = $idInstansi;
            $ref->save();
        }

        return back();
    }
}
