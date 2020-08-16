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
            'dataLibur' => Holiday::select('id', 'holi_date as tgl', 'desc as ket')
                                    ->where('holi_date','like', "%$thn%")
                                    ->orderBy('holi_date', 'asc')
                                    ->get(),
            'thn'       =>$thn,
            'bln'       =>''
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
            'tgl'   => 'required|unique:holidays,holi_date',
            'desc'  => 'required'
        ]);

        $hd             = new Holiday();
        $hd->holi_date  = $req->tgl;
        $hd->desc       = $req->desc;
        $hd->save();
        
        $msg =['success' => 'Hari libur berhasil ditambahkan'];

        return back()->with($msg);
    }

    public function postSearchHoliday(Request $req){
        $this->validate($req, ['thn' => 'required']);

        if($req->bln == null){
            $bln = '';
        }else{
            $bln = sprintf("%02d", $req->bln);
        }

        $data = [
            'dataLibur' => Holiday::select('id', 'holi_date as tgl', 'desc as ket')
                                    ->where('holi_date','like', "%$req->thn-$bln%")
                                    ->orderBy('holi_date', 'asc')
                                    ->get(),
            'thn'       =>$req->thn,
            'bln'       =>$bln
        ];

        return view('admin.setholiday')->with($data);
    }

    public function deleteHoliday($id){
        try {
            $hd = Holiday::find($id);
            $hd->delete();
            $msg = ['success' => 'Data berhasil dihapus'];
        } catch (\Throwable $th) {
            $msg = ['error' => 'Gagal menghapus data'];
        }

        return back()->with($msg);
    }
}
