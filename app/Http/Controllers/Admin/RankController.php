<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RankController extends Controller
{
    public function index(){
        $data = [
            'ranks' => ''
        ];

        return view('admin.setrank')->with($data);
    }
}
