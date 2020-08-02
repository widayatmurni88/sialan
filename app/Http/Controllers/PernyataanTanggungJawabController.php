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
        return Surattj::select('id', 'periode', 'file_link as link')
                        ->where('periode', 'like', "%$periodeTahun%")
                        ->where('instansi_id', $instansi)
                        ->orderBy('periode', 'ASC')
                        ->get();
    }

    public function showFormTambahPernyataan($tahun){
        $data = ['periode' => $tahun];
        return view('surattjs_add')->with($data);
    }

    public function postPernyataan(Request $req){
        $this->validate($req, [
            'bulan'     => 'required|numeric',
            'tahun'     => 'required|numeric',
            'surattjs'  => 'required|mimes:jpg,jpeg,png'
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

    public function postEditData(Request $req){
        $this->validate($req, [
            'id'    => 'required',
            'bulan' => 'required',
            'tahun' => 'required'
        ]);

        if ($req->file('surattjs')!=null)  {
            $this->validate($req,[
                'surattjs' => 'required|mimes:jpg,jpeg,png'
            ]);
        }

        try {
            $pernyataan = Surattj::find($req->id);
            $pernyataan->periode        = date('Y-m-d', strtotime($req->tahun .'-'.$req->bulan . '-01'));

            if ($req->file('surattjs')!=null){
                $id = $pernyataan->file_link;
                $file = $req->file('surattjs');
                $fileName = $id.'.'.$file->getClientOriginalExtension();
                $path = public_path('docs/pernyataan');
                if(!\File::isDirectory($path)) {
                    \File::makeDirectory($path, 0775, true, true);
                }
                $file->move($path,$fileName);
            }

            $pernyataan->update();

            $msg = ['success' => 'Berhasil diupdate'];

            return back()->with($msg);
        } catch (\Throwable $th) {
            $msg = ['error' => 'Gagal diupdate'];

            return back()->with($msg);
        }

    }

}
