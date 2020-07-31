<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PernyataanTanggungJawabController extends Controller
{
    public function index(){
        $data = [];
        return view('surattjs')->with($data);
    }
}
