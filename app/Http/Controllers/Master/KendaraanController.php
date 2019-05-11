<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KendaraanController extends Controller
{
    public function kendaraan(){
    	return view('master.kendaraan.kendaraan');
    }
    public function tambah_kendaraan(){
    	return view('master.kendaraan.tambah_kendaraan');
    }
}
