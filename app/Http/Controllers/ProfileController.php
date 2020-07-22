<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;

class ProfileController extends Controller{
    public function index(){
        $nid = session()->get('nid');
        $data = [
            'ranks'       => \DB::table('rank_users')->select('id', 'pangkat as rank')->get(),
            'profil_data' => \DB::table('biodatas')
                                ->select('nid as id', 'nama as name', 'tmpt_lahir as place_bd', 'tgl_lahir as date_bd', 'jkel as kel', 'pangkat_id as rank')
                                ->where('nid', $nid)->first()
        ];

        return view('profile')->with($data);
    }

    public function updateProfile(Request $req){
        $this->validate($req,[
            'nid'           => 'required|max:20',
            'name'          => 'required',
            'tmpt_lahir'    => 'required',
            'tgl_lahir'     => 'required',
            'pangkat'       => 'required'

        ]);

        $curNid = session()->get('nid');

        $bio = Biodata::find($curNid);
        $bio->nid           = $req->nid;
        $bio->nama          = $req->name;
        $bio->tmpt_lahir    = $req->tmpt_lahir;
        $bio->tgl_lahir     = $req->tgl_lahir;
        $bio->jkel          = $req->jkel;
        $bio->pangkat_id    = $req->pangkat;
        $bio->update();

        $updateSes = new LoginController();
        $updateSes->setSessionData($req->nid, true);

        return back();
    }
}
