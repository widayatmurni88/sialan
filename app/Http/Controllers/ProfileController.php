<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AcountsController;
use App\Models\Biodata;
use App\Models\User;
//use Image;

class ProfileController extends Controller{
    public function index(){
        $nid = session()->get('nid');
        $data = [
            'ranks'       => \DB::table('rank_users')->select('id', 'pangkat as rank')->get(),
            'profil_data' => \DB::table('biodatas')
                                ->select('nid as id', 'nama as name', 'tmpt_lahir as place_bd', 'tgl_lahir as date_bd', 'jkel as kel', 'pangkat_id as rank', 'profil_img as photo')
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

    public function updateAkun(){
        $data = [
            'email' => auth()->user()->email,
            'photo' => Biodata::where('nid',session()->get('nid'))->select('profil_img as photo')->first()->photo
        ];
        return view('updateakun')->with($data);
    }

    public function uploadFoto(Request $req){
        $this->validate($req,['photo' => 'required|image|mimes:jpeg,png,jpg']);
        $img     = $req->file('photo');
        $imgName = session()->get('nid'). '.' . $img->getClientOriginalExtension();
        $img->move('imgs/profiles', $imgName);

        $curNid = session()->get('nid');

        $bio = Biodata::find($curNid);
        $bio->profil_img = $imgName;
        $bio->update();

        //resize image
        // $destinationPath = public_path('imgs/profiles/thumbnail');
        // $img = Image::make($image->path());
        // $img->resize(300, 310, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save($destinationPath.'/'. $imgName);

        return back();
    }

    public function postChangeAkun(Request $req){
        $this->validate($req,[
            'email'     => 'required',
            'password'  => 'required|confirmed'
        ]);
        
        $akun = new AcountsController();

        if($akun->setNewPassword($req)){
            $updateSes = new LoginController();
            $updateSes->setSessionData(session()->get('nid'), true);
            return back()->with(['success' => 'Change has been saved.']);
        }else{
            return abort(500);
        }
    }
}
