<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KinerjaController extends Controller
{
    public function index($id){
        return view('kinerja')->with('');
    }
}
