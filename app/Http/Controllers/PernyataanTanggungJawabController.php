<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surattj;

class PernyataanTanggungJawabController extends Controller{

    public function index(){
        $thn=date('Y', strtotime(now()));
        
        $data = [
            'periode' => $thn,
            'data'    => $this->getPernyataanPerInstansiPerTahun($thn, session()->get('id_instansi'))
        ];
        return view('surattjs')->with($data);
    }

    public function getPernyataanBy($tahun){
        $data = [
            'periode' => $tahun,
            'data'    => $this->getPernyataanPerInstansiPerTahun($tahun, session()->get('id_instansi'))
        ];

        return view('surattjs')->with($data);
    }

    public function getPernyataanByTahun(Request $req){
        $this->validate($req, ['tahun' => 'required']);

        return $this->getPernyataanBy($req->tahun);
    }


    public function getPernyataanPerInstansiPerTahun($periodeTahun, $instansi){
        return Surattj::select('id', 'periode')
                        ->where('periode', 'like', "%$periodeTahun%")
                        ->where('instansi_id', $instansi)
                        ->orderBy('periode', 'ASC')
                        ->get();
    }


    public function showFormTambahPernyataan(){
        return view('surattjs_add');
    }

    public function postPernyataan(Request $req){
        $this->validate($req, [
            'bulan'     => 'required|numeric',
            'tahun'     => 'required|numeric',
            'surattjs'  => 'required|mimes:jpg,jpeg,png,pdf'
        ]);

        //upload filen
        try {
            $id = date('YmdHis', strtotime(now()));
            $fileName = '';
            $file = $req->file('surattjs');
            
            if($file != null){
                $fileName = $id.'.'.$file->getClientOriginalExtension();
                $path = public_path('docs/pernyataan');
                if(!\File::isDirectory($path)) {
                    \File::makeDirectory($path, 0775, true, true);
                }
                $file->move($path,$fileName);
            }

            $pernyataan = new Surattj();
            $pernyataan->bio_nid        = session()->get('nid');
            $pernyataan->instansi_id    = session()->get('id_instansi');
            $pernyataan->periode        = date('Y-m-d', strtotime($req->tahun .'-'.$req->bulan . '-01'));
            $pernyataan->file_link      = $fileName;
            $pernyataan->save();

            $msg = ['success' => 'Berhasil disimpan'];
            return back()->with($msg);

        } catch (\Throwable $th) {
            return abort(500);
        }

    }

    public function deletePernyataan($id){
        
        $pernyataan = Surattj::find($id);
        $fileName = $pernyataan->file_link;
        try {
            if(\File::exists(public_path('docs/pernyataan/').$fileName)){
                \File::delete(public_path('docs/pernyataan/').$fileName);
            }
            $pernyataan->delete();
            $msg = ['success' => 'Data dihapus'];
        } catch (\Throwable $th) {
            $msg = ['error' => 'Gagal menghapus data'];
        }
        return back()->with($msg);
    }

    public function editPernyataan($tahun, $id){
        $pernyataan = Surattj::find($id);
        $data = [
            'periode' => $tahun,
            'data'    => Surattj::find($id)
        ];
        return view('surattjs_edit')->with($data);
    }

}
