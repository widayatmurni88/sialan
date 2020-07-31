<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surattj;

class PernyataanTanggungJawabController extends Controller{

    public function index(){
        $thn=date('Y', strtotime(now()));
        
        $data = [
            'periode' => $thn,
            'data'    => $this->getPernyataanPerInstansiPerTahun($thn, session()->get('id_instansi'))
        ];
        return view('surattjs')->with($data);
    }

    public function getPernyataanByTahun(Request $req){
        $this->validate($req, ['tahun' => 'required']);
        $data = [
            'periode' => $req->tahun,
            'data'    => $this->getPernyataanPerInstansiPerTahun($req->tahun, session()->get('id_instansi'))
        ];

        return view('surattjs')->with($data);
    }


    public function getPernyataanPerInstansiPerTahun($periodeTahun, $instansi){
        return Surattj::select('id', 'periode')
                        ->where('periode', 'like', "%$periodeTahun%")
                        ->where('instansi_id', $instansi)
                        ->orderBy('periode', 'ASC')
                        ->get();
    }


}
