<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Holiday;

class HolidayController extends Controller{
    
    public function index($thn = null){

        if($thn == null){
            $thn = date('Y', strtotime(now()));
        }

        return $this->getLibur($thn);
    }

    public function getLibur($thn){
        $data = [
            'dataLibur' => Holiday::select('id', 'holi_date as tgl', 'desc as ket')->where('holi_date','like', '%'. $thn. '%')->orderBy('id', 'desc')->get(),
            'thn'=>$thn
        ];

        return view('admin.setholiday')->with($data);
    }

    public function tambahlibur($thn){
        $data = [
            'thn' => $thn
        ];
        return view('admin.setholiday_add')->with($data);
    }

    public function postHoliday(Request $req){
        $this->validate($req, [
            'tgl'   => 'required',
            'desc'  => 'required'
        ]);

        $hd             = new Holiday();
        $hd->holi_date  = $req->tgl;
        $hd->desc       = $req->desc;
        $hd->save();
        
        return back();
    }
}
