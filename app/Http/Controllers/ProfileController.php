<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller{
    public function index($id){
        $data = \DB::table('users')
                ->select('id','name as nama', 'email')
                ->where('id','=', $id)
                ->get();

        return view('profile')->with('data',$data);
    }
}
