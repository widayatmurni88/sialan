<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TtdReference;
use App\Models\Biodata;

class TtdReferenceController extends Controller
{
    public function getReferencePerson($nid){
        return Biodata::select('nid', 'nama', 'pangkat_id', 'pangkat')
                        ->leftJoin('ranks', 'ranks.id', '=', 'biodatas.pangkat_id')
                        ->where('biodatas.nid', $nid)
                        ->first();
    }

    public function getReferencePersonInstansi($idInstansi){
        return Biodata::select('nid as id', 'nama as name')
                        ->where('instansi_id', $idInstansi)
                        ->get();
    }

    public function seveReference(Request $req){
        
    }
}
