<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller{
    public function index($nid){
        $data = [
            'ranks'       => \DB::table('rank_users')->select('id', 'pangkat as rank')->get(),
            'profil_data' => \DB::table('biodatas')
                                ->select('nid as id', 'nama as name', 'tmpt_lahir as place_bd', 'tgl_lahir as date_bd', 'pangkat_id as rank')
                                ->where('nid', $nid)->first()
        ];

        return view('profile')->with($data);
    }

    public function updateProfil(Request $req){
        
    }
}
