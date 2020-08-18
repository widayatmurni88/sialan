<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\RegisterController;
use App\Models\User;
use App\Models\Biodata;
use App\Models\Rank;
use App\Models\Instansi;

class AcountsController extends Controller{

    public function index(){
        $data = [
            'acounts' => User::select('users.id as akun_id', 
                                      'users.email as email', 
                                      'users.level as lvl', 
                                      'users.bio_nid as nid', 
                                      'bio.nama as name')
                            ->leftJoin('biodatas as bio', 'bio.nid', '=', 'users.bio_nid')
                            ->orderBy('users.level', 'ASC')
                            ->get()
        ];
        return view('admin.manageakun')->with($data);
    }

    public function addAccount(){
        return view('admin.manageakun_add');
    }

    public function postAddAccount(Request $req){
        $register = new RegisterController();
        return $register->postRegister($req);
    }

    public function searchAccount(Request $req){
        
        if(trim($req->cari) == ''){
            return $this->index();
        }else{
            $data = [
                'acounts' => User::select('users.id as akun_id', 
                                        'users.email as email', 
                                        'users.level as lvl', 
                                        'users.bio_nid as nid', 
                                        'bio.nama as name')
                                ->leftJoin('biodatas as bio', 'bio.nid', '=', 'users.bio_nid')
                                ->where('bio.nama', 'like', "%$req->cari%")
                                ->orWhere('bio.nid', 'like', "%$req->cari%")
                                ->orWhere('users.email', 'like', "%$req->cari%")
                                ->orderBy('users.level', 'ASC')
                                ->get()
            ];
            return view('admin.manageakun')->with($data);
        }
    }

    public function deleteAkun($id){
        $curActive = auth()->user();
        if ($curActive->id == $id){
            $msg = ['error' => 'Forbiden delete'];
        }else{
            $user = User::find($id);
            $bio = Biodata::where('nid',$user->bio_nid);
            $bio->delete();
            // $user->delete();
            $msg = ['success' => 'User berhasil di hapus'];
        }

        return back()->with($msg);
    }

    public function resetUserPassword($uid){
        $user = User::find($uid);
        $user->password = bcrypt('123456789');
        $user->update();

        return back()->with(['rsuccess' => 'Reset berhasil dilakukan']);
    }

    public function previewAccount($userid){         
        $data = [
            'userakun'  => $this->getAccount($userid),
            'pangkat'   => Rank::all(),
            'instansi'  => Instansi::all()
        ];

        return view('admin.manageakun_preview')->with($data);
    }

    public function postUpdateAccount($userid, Request $req){
        
        $this->validate($req, [
            'uid'       => 'required',
            'email'     => 'required',
            'level'     => 'required',
            'nid'       => 'required'
        ]);

        $curAkun = $this->getAccount($userid);

        //email & level tbl users
        $msg = null;
        $user = User::find($userid);
        $userdirubah = false;
        
        if ($curAkun->uemail != $req->email){
            $this->validate($req, ['email' => 'unique:users,email']);
            $user->email = $req->email;
            $userdirubah = true;
        }

        if($curAkun->ulevel != $req->level){
            $user->level = $req->level;
            $userdirubah = true;
        }

        if($userdirubah){
            $user->update();
            $msg = ['success' => 'Update berhasil'];
        }

        //update biodata

        $bio = Biodata::find($curAkun->nid);
        $biodirubah = false;

        if($curAkun->nid != $req->nid){
            $this->validate($req, ['nid' => 'unique:biodatas,nid']);
            $bio->nid = $req->nid;
            $biodirubah = true;
        }

        if($curAkun->nama != $req->nama){
            $bio->nama = $req->nama;
            $biodirubah = true;
        }

        if ($curAkun->tlahir != $req->tlahir) {
            $bio->tmpt_lahir = $req->tlahir;
            $biodirubah = true;
        }

        if ($curAkun->tgllahir != $req->tgllahir) {
            $bio->tgl_lahir = $req->tgllahir;
            $biodirubah = true;
        }

        if ($curAkun->jkel != $req->jkel) {
            $bio->jkel = $req->jkel;
            $biodirubah = true;
        }

        if ($curAkun->pangkat_id != $req->pangkat) {
            $bio->pangkat_id = $req->pangkat;
            $biodirubah = true;
        }

        if ($curAkun->instansi_id != $req->unit) {
            $bio->instansi_id = $req->unit;
            $biodirubah = true;
        }

        if($biodirubah){
            $bio->update();
            $msg = ['success' => 'Update berhasil'];
        }

        return back()->with($msg);

    }

    protected function getAccount($userid){
        return User::select('users.id as uid', 'users.email as uemail', 'users.level as ulevel',
                            'biodatas.nid', 'biodatas.nama', 'biodatas.tmpt_lahir as tlahir', 'biodatas.tgl_lahir as tgllahir', 'biodatas.jkel', 'biodatas.pangkat_id', 'ranks.pangkat', 'biodatas.instansi_id', 'instansis.nama_ins', 'biodatas.profil_img as img')
                    ->join('biodatas', 'biodatas.nid', '=', 'users.bio_nid')
                    ->join('ranks', 'ranks.id', '=', 'biodatas.pangkat_id')
                    ->join('instansis', 'instansis.id', '=', 'biodatas.instansi_id')
                    ->where('users.id', $userid)
                    ->first(); 
    }
}
