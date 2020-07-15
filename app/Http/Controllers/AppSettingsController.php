<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;

class AppSettingsController extends Controller{

    public function setupHariLibur($thn='2020'){
        $data = [
            'dataLibur' => Holiday::select('id', 'holi_date as tgl', 'desc as ket')->where('holi_date','like', '%'. $thn. '%')->orderBy('id', 'desc')->get(),
            'thn'=>$thn
        ];
        return view('appsetting.setupharilibur')->with($data);
    }

    public function getHariLiburByTahun(Request $req){
        return redirect()->route('getHariLibur', $req->tahun);
    }

    public function addHariLibur($thn){
        return view('appsetting.setupHariLibur_add')->with( ['thn' => $thn]);
    }

    public function postHariLibur(Request $req){
        $this->validate($req, [
            'tgl'   => 'required|date|unique:holidays,holi_date',
            'desc'  => 'required'
        ]);

        $hodiday = new Holiday();
        $hodiday->holi_date = $req->tgl;
        $hodiday->desc = $req->desc;
        $hodiday->save();

        return redirect()->route('getHariLibur', $req->tahun);
    }

    public function editHariLibur($thn, $id){
        $data = [
            'libur' => Holiday::select('id', 'holi_date as tgl', 'desc as ket')->where('id','=',$id)->get(),
            'thn' => $thn
        ];
        return view('appsetting.setupHariLibur_edit')->with($data);
    }

    public function postEditHariLibur($thn, $id, Request $req){

        $this->validate($req, [
            'tgl' => 'required|date',
            'desc' => 'required'
        ]);
        
        $hd = Holiday::find($id);
        if (($req->tgl != $hd->holi_date)) {
            $this->validate($req,[
                'tgl' => 'unique:holidays,holi_date'
            ]);
            $hd->holi_date = $req->tgl;
        }
        $hd->desc = $req->desc;
        $hd->update();
        
        return redirect()->route('getHariLibur', $thn);
    }

    public function deleteHariLibur($thn, $id){
        $hd = Holiday::find($id);
        $hd->delete();

        return redirect()->route('getHariLibur', $thn);
    }

}
