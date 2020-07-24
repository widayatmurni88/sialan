<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index(){
        $idAbsen = new AbsenKegiatanController();
        $idAbsen = $idAbsen->getIdAbsen(session()->get('nid'));

        if ($idAbsen != null ){
            $kegiatan = new LaporanHarianController();
            $kegiatan = $kegiatan->getKegiatan($idAbsen);
        }

        $data = [
            'idabsen' => $idAbsen, 
            'kegiatan' => $kegiatan
        ];
        return view('dashboard')->with($data);
    }
}
