<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instansi;

class InstansiController extends Controller{
    public function index(){
        $data = [
            'instansi' => Instansi::All()
        ];

        return view ('admin.instansi')->with($data);
    }

    public function addInstansi(){
        return view('admin.instansi_add');
    }
}
