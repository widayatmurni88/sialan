<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surattj;

class PernyataanTanggungJawabController extends Controller
{
    public function index(){
        $thn=date('Y', strtotime(now()));
        $idInstansi = session()->get('id_instansi');
        $data = [
            'periode' => $thn,
            'data'    => $this->getPernyataanPerInstansiPerTahun($thn, $idInstansi)
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
