<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\InstansiController;


class DashboardController extends Controller
{
    public function index(){

        $abs = new AbsenKegiatanController();
        $idAbsen = $abs->getIdAbsen(session()->get('nid'));
        $absen   = $abs->getAbsenNow(session()->get('nid'));

        if ($idAbsen != null ){
            $kegiatan = new LaporanHarianController();
            $kegiatan = $kegiatan->getKegiatan($idAbsen);
        }

        $instansi = new InstansiController();
        $instansi = $instansi->getInstansi(session()->get('id_instansi'));

        $data = [
            'idabsen'   => $idAbsen,
            'absen'     => $absen,
            'kegiatan'  => $kegiatan,
            'instansi'  =>  $instansi
        ];
        return view('dashboard')->with($data);
    }
}
