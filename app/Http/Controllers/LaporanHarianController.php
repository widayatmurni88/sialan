<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanHarianController extends Controller
{
    public function index(){
        return view('lapkegiatanharian');
    }

    public function addKegiatanHarian(){
        return view('dok_kegiatan_add');
    }
}
