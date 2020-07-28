<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\InstansiController;


class DashboardController extends Controller
{
    public function index(){
        $idAbsen = new AbsenKegiatanController();
        $idAbsen = $idAbsen->getIdAbsen(session()->get('nid'));

        if ($idAbsen != null ){
            $kegiatan = new LaporanHarianController();
            $kegiatan = $kegiatan->getKegiatan($idAbsen);
        }

        $instansi = new InstansiController();
        $instansi = $instansi->getInstansi(session()->get('id_instansi'));

        $data = [
            'idabsen' => $idAbsen, 
            'kegiatan' => $kegiatan,
            'instansi' =>  $instansi
        ];
        return view('dashboard')->with($data);
    }
}
