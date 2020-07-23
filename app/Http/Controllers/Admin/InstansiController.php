<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instansi;

class InstansiController extends Controller{
    public function index(){
        $data = [
            'instansi' => Instansi::select('id', 'nama_ins as name', 'alamat as addr')->orderBy('id', 'DESC')->get()
        ];

        return view ('admin.instansi')->with($data);
    }

    public function addInstansi(){
        return view('admin.instansi_add');
    }

    public function postAddInstansi(Request $req){

        $this->validate($req,[
            'name'    => 'required',
            'address' => 'required'
        ]);

        $ins = new Instansi();
        $ins->nama_ins  = $req->name;
        $ins->alamat    = $req->address;
        $ins->save();

        $msg = ['success' => 'Instansi ditambahkan.'];
        
        return back()->with($msg);
    }

    public function deleteInstansi($id){
        try {
            $ins = Instansi::find($id);
            $ins->delete();
            $msg = ['success' => 'Data instansi di hapus'];
        } catch (\Throwable $th) {
            $msg = ['error' => 'Gagal menghapus data'];
        }

        return back()->with($msg);
    }

    public function editInstansi($id){
        $data = [
            'instansi' => Instansi::where('id',$id)->select('id', 'nama_ins as name', 'alamat as addr')->first()
        ];

        return view('admin.instansi_edit')->with($data);
    }

    public function postEditInstansi(Request $req){
        $this->validate($req,[
            'id'        => 'required',
            'name'      => 'required',
            'address'   => 'required'
        ]);

        try {
            $ins            = Instansi::find($req->id);
            $ins->nama_ins  = $req->name;
            $ins->alamat    = $req->address;
            $ins->update();
            $msg = ['success' => 'Perubahan telah disimpan'];
        } catch (\Throwable $th) {
            $msg = ['error' => 'Gagal menyimpan perubahan'];
        }

        return redirect()->route('instansi')->with($msg);
    }

    public function searchInstansi(Request $req){
        if (trim($req->cari) == ''){
            $data = [
                'instansi' => Instansi::select('id', 'nama_ins as name', 'alamat as addr')->orderBy('id','DESC')->get()
            ];
        }else{
            $data = [
                'instansi' => Instansi::where('nama_ins', 'like', "%$req->cari%")->select('id', 'nama_ins as name', 'alamat as addr')->orderBy('id','DESC')->get()
            ];
        }

        return view('admin.instansi')->with($data);
    }
}
