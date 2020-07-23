<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsenKegiatanController extends Controller
{
    public function Absensi(Request $req){
        dd($req->nid);
    }
}
