<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AcountsController extends Controller
{
    public function index(){
        return view('admin.manageakun');
    }

    public function deleteAkun($id){
        # code...
    }
}
