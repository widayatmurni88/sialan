<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;

class _cekHariLibur extends Controller{
    
    public function ceklibur($tgl){
        $libur = [
            'status'=> false,
            'data'  => ''
        ];

        $hd = Holiday::select('id', 'holi_date as tgl', 'desc as ket')
                        ->where('holi_date', 'like', "%$tgl%")
                        ->first();
        if ($hd != null){
            $libur['status'] = true;
            $libur['data']   = $hd;
        }

        return $libur;
    }
}
